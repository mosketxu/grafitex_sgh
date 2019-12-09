@if(Session::has('message'))
toastr.options={
    progressBar:true,
    positionClass:"toast-top-center"
};
toastr.success("{{ Session::get('message') }}");
@endif
@if ($errors->any())
@foreach ($errors->all() as $error)
toastr.options={
    closeButton: true,
    progressBar:true,
    positionClass:"toast-top-center",
    showDuration: "300",
    hideDuration: "1000",
    timeOut: 0,
};
toastr.error("{{ $error }}");
@endforeach
@endif
