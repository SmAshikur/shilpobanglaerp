<div class="mt-12 bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-indigo-100/30 overflow-hidden" x-data="{ showForm: false, editingId: null }">
    <div class="p-8 border-b border-slate-50 flex items-center justify-between bg-slate-50/50">
        <div>
            <h4 class="text-xl font-black text-slate-800">Extra Details</h4>
            <p class="text-xs text-slate-500 mt-1">Add more sections like Features, FAQs, or Specifications</p>
        </div>
        <button @click="showForm = true; editingId = null" class="w-10 h-10 bg-indigo-600 text-white rounded-xl flex items-center justify-center hover:bg-indigo-700 transition shadow-lg shadow-indigo-100">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
        </button>
    </div>

    <!-- Details List -->
    <div class="p-8 space-y-6">
        @forelse($model->extraDetails as $detail)
            <div class="p-6 bg-slate-50 rounded-[2rem] border border-slate-100 group relative">
                <div class="flex justify-between items-start mb-2">
                    <h5 class="text-lg font-bold text-slate-800">{{ $detail->title ?? 'Untitled Detail' }}</h5>
                    <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                        <button @click="showForm = true; editingId = {{ $detail->id }}; $nextTick(() => { 
                            $refs.titleInput.value = '{{ addslashes($detail->title) }}';
                            $refs.descInput.value = '{{ addslashes($detail->description) }}';
                            $refs.formAction.action = '{{ route('dashboard.extra-details.update', $detail) }}';
                            $refs.methodInput.value = 'PUT';
                        })" class="p-2 bg-amber-50 text-amber-600 rounded-lg hover:bg-amber-500 hover:text-white transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                        </button>
                        <form action="{{ route('dashboard.extra-details.destroy', $detail) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-2 bg-rose-50 text-rose-600 rounded-lg hover:bg-rose-500 hover:text-white transition" onclick="return confirm('Remove this detail?')">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </form>
                    </div>
                </div>
                <p class="text-sm text-slate-600 leading-relaxed italic">{!! nl2br(e($detail->description)) !!}</p>
            </div>
        @empty
            <div class="py-10 text-center border-2 border-dashed border-slate-100 rounded-[2rem] bg-slate-50/30">
                <p class="text-sm text-slate-400 font-bold">No extra details added yet.</p>
            </div>
        @endforelse
    </div>

    <!-- Modal Form -->
    <div x-show="showForm" x-cloak class="fixed inset-0 z-[60] flex items-center justify-center p-6 bg-slate-900/60 backdrop-blur-sm">
        <div class="bg-white w-full max-w-xl rounded-[3rem] shadow-2xl overflow-hidden" @click.away="showForm = false">
            <div class="p-8 bg-slate-50 border-b border-slate-100 flex justify-between items-center">
                <h3 class="text-xl font-black text-slate-800" x-text="editingId ? 'Edit Detail' : 'Add New Detail'"></h3>
                <button @click="showForm = false" class="text-slate-400 hover:text-slate-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
            <form x-ref="formAction" action="{{ route('dashboard.extra-details.store') }}" method="POST" class="p-10 space-y-6">
                @csrf
                <input type="hidden" name="_method" x-ref="methodInput" value="POST">
                <input type="hidden" name="detailable_id" value="{{ $model->id }}">
                <input type="hidden" name="detailable_type" value="{{ class_basename($model) }}">
                
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Short Title (Optional)</label>
                    <input type="text" name="title" x-ref="titleInput" placeholder="e.g. Technical Specs" class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition">
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Description</label>
                    <textarea name="description" x-ref="descInput" rows="5" required placeholder="Describe the feature or detail here..." class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition"></textarea>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="button" @click="showForm = false" class="flex-1 py-4 bg-slate-100 text-slate-600 font-bold rounded-2xl hover:bg-slate-200 transition">Cancel</button>
                    <button type="submit" class="flex-1 py-4 bg-indigo-600 text-white font-bold rounded-2xl hover:bg-indigo-700 transition shadow-xl shadow-indigo-100">Save Detail</button>
                </div>
            </form>
        </div>
    </div>
</div>
