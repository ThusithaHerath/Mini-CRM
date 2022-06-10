@component('mail::message')
    New user has been added successfully ! 
    @component('mail::button',['url'=>'http://127.0.0.1:8000/manage-companies?page=1'])
    Click here 
    @endcomponent
@endcomponent