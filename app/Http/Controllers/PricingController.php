<?php

namespace App\Http\Controllers;

use App\Models\Pricing;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Pricing::query();

            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            }

            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            $pricing = $query->orderBy('id', 'desc')->paginate(100);

            return view('admin.pricing.index', compact('pricing'));
        } catch (\Exception $e) {
            \Log::error('Semester index error: '.$e->getMessage());

            return back()->with('error', 'Something went wrong while fetching pricing.');
        }
    }

    public function create()
    {
        return view('admin.pricing.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        try {
            Pricing::create([
                'name' => $request->name,
                'price' => $request->price,
                'status' => 'Active',
            ]);

            return redirect()->route('admin.pricing.index')->with('success', 'Pricing created successfully.');
        } catch (\Exception $e) {
            \Log::error('Pricing store error: '.$e->getMessage());

            return back()->withInput()->with('error', 'Something went wrong while creating pricing.');
        }
    }

    public function edit($id)
    {
        try {
            $pricing = Pricing::findOrFail($id);

            return view('admin.pricing.edit', compact('pricing'));
        } catch (\Exception $e) {
            \Log::error('Pricing edit error: '.$e->getMessage());

            return back()->with('error', 'Pricing not found.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        try {
            $pricing = Pricing::findOrFail($id);
            $pricing->update([
                'name' => $request->name,
                'price' => $request->price,
            ]);

            return redirect()->route('admin.pricing.index')->with('success', 'Pricing updated successfully.');
        } catch (\Exception $e) {
            \Log::error('Pricing update error: '.$e->getMessage());

            return back()->withInput()->with('error', 'Something went wrong while updating pricing.');
        }
    }

    public function destroy($id)
    {
        try {
            $pricing = Pricing::findOrFail($id);
            $pricing->delete();

            return redirect()->route('admin.pricing.index')->with('success', 'Pricing deleted successfully.');
        } catch (\Exception $e) {
            \Log::error('Pricing delete error: '.$e->getMessage());

            return back()->with('error', 'Something went wrong while deleting pricing.');
        }
    }

    public function toggleStatus($id)
    {
        try {
            $pricing = Pricing::findOrFail($id);
            $pricing->status = $pricing->status === 'Active' ? 'Inactive' : 'Active';
            $pricing->save();

            return redirect()->route('admin.pricing.index')->with('success', 'Pricing status updated successfully.');
        } catch (\Exception $e) {
            \Log::error('Pricing status toggle error: '.$e->getMessage());

            return back()->with('error', 'Something went wrong while updating pricing status.');
        }
    }
}
