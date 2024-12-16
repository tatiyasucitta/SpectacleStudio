@extends('layouts.master')

@section('content')
    <h2 style="padding: 20px 0; text-align: center; color: #736960;">Your Ongoing Orders</h2>
    
    @php
        $a=0;
    @endphp
    @for($i = 0 ; $i < count($fakturs) ; $i++)
        <div class="accordion" id="accordionPanelsStayOpenExample">
            <table class="table">
                <tbody>
                    <tr>
                        <th scope="row">{{$a+1}}</th>
                            <td>
                                <a href="{{route('detailinvoice', $fakturs[$i]->id)}}">
                                    <h5> Order Invoice:   {{$fakturs[$i]->invoice}}</h5>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @php 
                $a++;
            @endphp
    @endfor
@endsection