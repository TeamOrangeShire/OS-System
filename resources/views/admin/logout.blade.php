@if (session()->has('Admin_id'))
@php
        session()->forget('Admin_id');
  
    
        return redirect()->route('login');
    @endphp
@endif
