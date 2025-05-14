@extends('layouts.app')

@section('title', 'O Nama')

@section('content')

<div class="w3-container w3-padding-64 w3-red w3-grayscale w3-xlarge" id="about">
    <div class="w3-content">
        <h1 class="w3-center w3-jumbo w3-text-white" style="margin-bottom:64px">O Nama</h1>
        <p class="w3-text-white">Restoran Milos Gavrilovic je mesto gde se tradicija susreće sa modernom kuhinjom. Naša priča počinje sa strastvenim zalaganjem za kvalitetnu hranu i uslugu.</p>
        
        <div class="w3-row w3-padding-32">
            <div class="w3-col m6 w3-padding-large">
                <h1 class="w3-text-white"><b>Naša Priča</b></h1><br>
                <p class="w3-text-white">Osnovani 2010. godine, naš restoran je postao sinonim za kvalitetnu hranu i uslugu. Naš tim kuvara sa višedecenijskim iskustvom priprema jela koja će vas vratiti u detinjstvo.</p>
                <p class="w3-text-white">Svaki obrok je posebna priča, svako jelo je umetnost, a svaki gost je član naše porodice.</p>
            </div>
            
            <div class="w3-col m6 w3-padding-large">
                <div class="w3-row">
                    <div class="w3-col s6 w3-padding-small">
                        <img src="https://images.unsplash.com/photo-1544025162-d76694265947?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1169&q=80" class="w3-round w3-image w3-opacity-min" alt="Traditional Food" style="width:100%">
                    </div>
                    <div class="w3-col s6 w3-padding-small">
                        <img src="https://images.unsplash.com/photo-1559847844-5315695dadae?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1122&q=80" class="w3-round w3-image w3-opacity-min" alt="Mediterranean Food" style="width:100%">
                    </div>
                    <div class="w3-col s6 w3-padding-small">
                        <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1180&q=80" class="w3-round w3-image w3-opacity-min" alt="Vegan Food" style="width:100%">
                    </div>
                    <div class="w3-col s6 w3-padding-small">
                        <img src="https://images.unsplash.com/photo-1551024506-0bccd828d307?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1074&q=80" class="w3-round w3-image w3-opacity-min" alt="Dessert" style="width:100%">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 