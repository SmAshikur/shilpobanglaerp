@extends('layouts.dashboard')

@section('header', 'Create New Invoice')

@section('content')
<div class="max-w-6xl mx-auto" x-data="invoiceForm()">
    <form action="{{ route('dashboard.erp.invoices.store') }}" method="POST">
        @csrf
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight">Generate Invoice</h2>
                <p class="text-slate-500 dark:text-slate-400 mt-1 font-medium italic">Create a new bill for your clients</p>
            </div>
            <div class="flex gap-4">
                <button type="submit" name="status" value="draft" class="px-6 py-3 bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-400 font-bold rounded-2xl hover:bg-slate-200 dark:hover:bg-white/10 transition-all">
                    Save as Draft
                </button>
                <button type="submit" name="status" value="unpaid" class="px-6 py-3 bg-indigo-600 text-white font-bold rounded-2xl hover:bg-indigo-700 shadow-xl shadow-indigo-600/20 transition-all">
                    Create & Send
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Side: Basic Info -->
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-white/5 shadow-2xl shadow-slate-200/50 dark:shadow-none p-10">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                        <div class="space-y-2">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Client</label>
                            <select name="client_id" required class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border-2 border-transparent focus:border-indigo-500 focus:bg-white dark:focus:bg-slate-700 outline-none font-bold text-slate-700 dark:text-white transition-all appearance-none">
                                <option value="">Select Client</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }} ({{ $client->company_name ?? 'Individual' }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Invoice Number</label>
                            <input type="text" name="invoice_number" value="{{ $nextInvoiceNumber }}" required class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border-2 border-transparent focus:border-indigo-500 focus:bg-white dark:focus:bg-slate-700 outline-none font-bold text-slate-700 dark:text-white transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Issue Date</label>
                            <input type="date" name="invoice_date" value="{{ date('Y-m-d') }}" required class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border-2 border-transparent focus:border-indigo-500 focus:bg-white dark:focus:bg-slate-700 outline-none font-bold text-slate-700 dark:text-white transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Due Date</label>
                            <input type="date" name="due_date" value="{{ date('Y-m-d', strtotime('+15 days')) }}" class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border-2 border-transparent focus:border-indigo-500 focus:bg-white dark:focus:bg-slate-700 outline-none font-bold text-slate-700 dark:text-white transition-all">
                        </div>
                    </div>

                    <!-- Line Items -->
                    <div>
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-black text-slate-800 dark:text-white uppercase tracking-widest">Line Items</h3>
                            <button type="button" @click="addItem()" class="px-4 py-2 bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 font-bold rounded-xl hover:bg-indigo-100 transition-all flex items-center gap-2 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                Add Item
                            </button>
                        </div>

                        <div class="space-y-4">
                            <template x-for="(item, index) in items" :key="index">
                                <div class="grid grid-cols-12 gap-4 items-center bg-slate-50 dark:bg-white/5 p-4 rounded-2xl border border-slate-100 dark:border-white/5">
                                    <div class="col-span-12 md:col-span-6">
                                        <input type="text" :name="`items[${index}][desc]`" x-model="item.desc" placeholder="Service description..." required class="w-full bg-transparent border-none outline-none font-bold text-slate-700 dark:text-white placeholder:text-slate-400">
                                    </div>
                                    <div class="col-span-4 md:col-span-2">
                                        <input type="number" :name="`items[${index}][qty]`" x-model.number="item.qty" placeholder="Qty" required class="w-full bg-transparent border-none outline-none font-bold text-slate-700 dark:text-white text-center">
                                    </div>
                                    <div class="col-span-4 md:col-span-3">
                                        <input type="number" :name="`items[${index}][price]`" x-model.number="item.price" placeholder="Price" required class="w-full bg-transparent border-none outline-none font-bold text-slate-700 dark:text-white text-right">
                                    </div>
                                    <div class="col-span-4 md:col-span-1 flex justify-end">
                                        <button type="button" @click="removeItem(index)" class="p-2 text-rose-500 hover:bg-rose-100 dark:hover:bg-rose-500/10 rounded-lg transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Summary -->
            <div class="lg:col-span-1">
                <div class="bg-indigo-600 dark:bg-indigo-900 rounded-[2.5rem] p-10 text-white shadow-2xl shadow-indigo-600/20 sticky top-28">
                    <h3 class="text-xl font-black uppercase tracking-widest mb-10 text-white/60">Summary</h3>
                    
                    <div class="space-y-6">
                        <div class="flex justify-between items-center text-lg">
                            <span class="font-medium text-white/70">Sub-total</span>
                            <span class="font-black" x-text="formatCurrency(calculateSubtotal())"></span>
                        </div>
                        <div class="flex justify-between items-center text-lg">
                            <span class="font-medium text-white/70">Tax (10%)</span>
                            <span class="font-black" x-text="formatCurrency(calculateTax())"></span>
                        </div>
                        <div class="pt-6 border-t border-white/10 flex justify-between items-center text-3xl">
                            <span class="font-bold text-white/60">Total</span>
                            <span class="font-black" x-text="formatCurrency(calculateTotal())"></span>
                        </div>
                    </div>

                    <div class="mt-12 p-6 bg-white/10 rounded-3xl border border-white/10 italic text-sm text-white/80">
                        Note: This total will be recorded in your financial reports upon creation.
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function invoiceForm() {
        return {
            items: [
                { desc: '', qty: 1, price: 0 }
            ],
            addItem() {
                this.items.push({ desc: '', qty: 1, price: 0 });
            },
            removeItem(index) {
                if (this.items.length > 1) {
                    this.items.splice(index, 1);
                }
            },
            calculateSubtotal() {
                return this.items.reduce((acc, item) => acc + (item.qty * item.price), 0);
            },
            calculateTax() {
                return this.calculateSubtotal() * 0.10;
            },
            calculateTotal() {
                return this.calculateSubtotal() + this.calculateTax();
            },
            formatCurrency(amount) {
                return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(amount);
            }
        }
    }
</script>
@endsection
