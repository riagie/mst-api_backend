<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\SalesDet;
use App\Models\Diskon;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function showBarang()
    {
        return Barang::all();
    }

    public function showCustomer()
    {
        return Customer::all();
    }

    public function showBarangWithDiskon()
    {
        return Barang::with('diskon')->get();
    }

    public function showTransaksi()
    {
        return Sale::with(['customer', 'salesDet'])->get();
    }

    public function inputTransaksi(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'kode' => 'required|string',
                'tanggal' => 'required|date',
                'cust_id' => 'required|string|exists:m_customer,kode',
                'barang' => 'required|array',
                'barang.*.kode' => 'required|string|exists:m_barang,kode',
                'barang.*.qty' => 'required|integer|min:1',
                'diskon' => 'required|numeric',
                'ongkir' => 'required|numeric',
            ]);

            $customer = Customer::where('kode', $request->cust_id)->firstOrFail();

            $subtotal = 0;
            $totalDiskon = $request->diskon;
            $totalBayar = 0;

            $sale = Sale::create([
                'kode' => $request->kode,
                'tgl' => $request->tanggal,
                'cust_id' => $customer->id,
                'subtotal' => $subtotal,
                'diskon' => $totalDiskon,
                'ongkir' => $request->ongkir,
                'total_bayar' => $totalBayar,
            ]);

            foreach ($request->barang as $item) {
                $barang = Barang::where('kode', $item['kode'])->firstOrFail();
                $qty = $item['qty'];
                $hargaBandrol = $barang->harga;
                $diskonPct = 0;
                $diskonNilai = 0;

                $diskon = Diskon::where('barang_id', $barang->id)->first();
                if ($diskon) {
                    $diskonPct = $diskon->diskon_pct;
                    $diskonNilai = $diskon->diskon_nilai;
                }

                $hargaDiskon = $hargaBandrol - ($hargaBandrol * ($diskonPct / 100)) - $diskonNilai;
                $total = $hargaDiskon * $qty;

                SalesDet::create([
                    'sales_id' => $sale->id,
                    'barang_id' => $barang->id,
                    'harga_bandrol' => $hargaBandrol,
                    'qty' => $qty,
                    'diskon_pct' => $diskonPct,
                    'diskon_nilai' => $diskonNilai,
                    'harga_diskon' => $hargaDiskon,
                    'total' => $total,
                ]);

                $subtotal += $hargaBandrol * $qty;
                $totalBayar += $total;
            }

            $sale->update([
                'subtotal' => $subtotal,
                'total_bayar' => $totalBayar + $request->ongkir - $totalDiskon,
            ]);

            DB::commit();
            return response()->json(['message' => 'Transaksi berhasil disimpan', 'sale' => $sale], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Transaksi gagal disimpan', 'error' => $e->getMessage()], 500);
        }
    }
}
