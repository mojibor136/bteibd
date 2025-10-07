<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function adminPaymentPending(Request $request)
    {
        $search = $request->input('search');

        $payments = Payment::where('status', 'pending')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('student_reg', 'like', "%{$search}%")
                        ->orWhere('method', 'like', "%{$search}%")
                        ->orWhere('number', 'like', "%{$search}%");
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(100)
            ->withQueryString();

        return view('admin.payment.pending', compact('payments'));
    }

    public function adminPaymentApproved(Request $request)
    {
        $search = $request->input('search');

        $payments = Payment::where('status', 'approved')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('student_reg', 'like', "%{$search}%")
                        ->orWhere('method', 'like', "%{$search}%")
                        ->orWhere('number', 'like', "%{$search}%");
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(100)
            ->withQueryString();

        return view('admin.payment.approved', compact('payments'));
    }

    public function branchPaymentPending(Request $request)
    {

        $search = $request->input('search');

        $payments = Payment::where('branch_id', Auth::id())
            ->where('status', 'pending')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('student_reg', 'like', "%{$search}%")
                        ->orWhere('method', 'like', "%{$search}%")
                        ->orWhere('number', 'like', "%{$search}%");
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(100)
            ->withQueryString();

        return view('branch.payment.pending', compact('payments'));
    }

    public function branchPaymentApproved(Request $request)
    {
        $search = $request->input('search');

        $payments = Payment::where('branch_id', Auth::id())
            ->where('status', 'approved')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('student_reg', 'like', "%{$search}%")
                        ->orWhere('method', 'like', "%{$search}%")
                        ->orWhere('number', 'like', "%{$search}%");
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(100)
            ->withQueryString();

        return view('branch.payment.approved', compact('payments'));
    }

    public function toggleStatus($id)
    {
        try {
            $payment = Payment::findOrFail($id);

            $payment->status = $payment->status === 'approved' ? 'pending' : 'approved';
            $payment->save();

            if ($payment->status === 'approved') {
                $student = Student::where('registration_no', $payment->student_reg)->first();

                if ($student) {
                    $student->status = 'Active';
                    $student->save();
                } else {
                    return redirect()->back()->with('error', 'Student not found for registration_no:'.$payment->student_reg);

                }
            }

            return redirect()->back()->with('success', 'Payment status updated successfully!');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Something went wrong while updating payment!');
        }
    }

    public function branchPaymentRequest()
    {
        return view('branch.payment.create');
    }

    public function branchPaymentStore(Request $request)
    {
        try {
            $validated = $request->validate([
                'student_reg' => 'required|string|max:255',
                'amount' => 'required|numeric|min:1',
                'method' => 'required|string|in:bkash,nagad,rocket,bank',
                'number' => 'required|string|max:255',
            ]);

            Payment::create([
                'student_reg' => $validated['student_reg'],
                'branch_id' => Auth::id(),
                'amount' => $validated['amount'],
                'method' => $validated['method'],
                'number' => $validated['number'],
                'status' => 'pending',
            ]);

            return redirect()
                ->route('branch.payment.approved')
                ->with('success', 'Payment request created successfully!');
        } catch (\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {

            return redirect()->back()
                ->with('error', 'Something went wrong while creating payment!')
                ->withInput();
        }
    }
}
