@if(session()->has('messages'))
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="alert {{ str_contains(session('messages'), 'Sukses') ? 'alert-success' : 'alert-danger' }} alert-has-icon">
    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
    <div class="alert-body">
        <div class="alert-title">{{ explode('-', session('messages'))[0] }}</div>
        {{ explode('-', session('messages'))[1] }}
    </div>
</div>
@endif
