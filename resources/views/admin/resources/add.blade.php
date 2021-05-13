@extends('app')

@section('content')
    <style>
        #confirmNavBox {
            margin-top: 200px;
        }

    </style>
    <div class="row">
        <div class="col-sm-12 contentBoxHolder">
            <div class="contentBox">
                @include("admin.resources.resourcesNav")

                @if($resourceType == "")

                    <h1>Fel</h1>

                @elseif($resourceType == "categories")

                    @include('admin.resources.products.create')

                @elseif($resourceType == "products")
                    <p><a href="/admin/resources/categories/add">Lägg till kategori</a></p>

                    <table class="table table-striped">
                        <tr>
                            <th>Artikel</th>
                            <th>Beskrivning</th>
                            <th>Bild</th>
                            <th>Pris/
                                Timme</th>
                            <th>Pris/ Halvdag</th>
                            <th>Pris/
                                dag</th>
                            <th>Pris/helg</th>
                            <th>Pris/ vecka</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td>
                                C 1
                            </td>
                            <td>Linder Aluminium, 3 sitsar</td>
                            <td></td>
                            <td>100</td>
                            <td>200</td>
                            <td>500</td>
                            <td>700</td>
                            <td>1500</td>
                            <td>Ändra/Lägg till/Ta bort</td>
                        </tr>
                    </table>
                @endif

            </div>
        </div>
    </div>

@endsection
