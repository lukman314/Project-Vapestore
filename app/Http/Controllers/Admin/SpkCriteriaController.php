<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SpkCriteria;
use Illuminate\Http\Request;

class SpkCriteriaController extends Controller
{
    public function index()
    {
        $criteria = SpkCriteria::all();
        return view('admin.spk.index', compact('criteria'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'criteria'             => 'required|array',
            'criteria.*.id'        => 'required|exists:spk_criteria,id',
            'criteria.*.weight'    => 'required|numeric|min:0.01|max:1',
            'criteria.*.type'      => 'required|in:benefit,cost',
        ]);

        $totalWeight = array_sum(array_column($request->criteria, 'weight'));

        if (abs($totalWeight - 1.0) > 0.001) {
            return back()->with('error', 'Total bobot harus sama dengan 1. Total saat ini: ' . $totalWeight);
        }

        foreach ($request->criteria as $item) {
            SpkCriteria::where('id', $item['id'])->update([
                'weight' => $item['weight'],
                'type'   => $item['type'],
            ]);
        }

        return redirect()->route('admin.spk.index')->with('success', 'Kriteria SPK berhasil diperbarui.');
    }
}
