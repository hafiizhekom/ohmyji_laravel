@extends('layouts.application_admin')
@section('pagetitle', 'Color')
@section('content')

    <div id="toolbar">
        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i></button>
    </div>

    <table data-toggle="table" data-pagination="true"
    data-search="true"
    data-toolbar="#toolbar">
        <thead>
        <tr>
            <th data-field="id" data-visible="false">ID</th>
            <th data-field="name" data-sortable="true">Color Name</th>
            <th data-field="code" data-sortable="true">Color Code</th>            
            <th data-field="hex" data-sortable="true">Color Hex</th>
            <th data-formatter="TableActions">Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($data['color'] as $key=>$value)
                <tr>
                    <td>{{$value->id}}</td>
                    <td>{{$value->color_name}}</td>
                    <td>{{$value->color_code}}</td>
                    <td>
                        @if($value->color_hex)
                            <i class="nav-icon fas fa-square-full" style="color:{{$value->color_hex}};"></i>
                            {{$value->color_hex}}
                        @endif
                    </td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('additionalJs')
        <script>

            $('.colorpicker').on('input',
                function() {
                    $('.example-colorpicker').html($(this).val());
                }
            );


            function TableActions (value, row, index) {
                return [
                    '<a class="text-warning" href="#" data-toggle="modal" data-target="#edit-',row.id,'">',
                    '<i class="fas fa-edit"></i>',
                    '</a> ',
                    '<a class="text-danger" href="#" data-toggle="modal" data-target="#delete-',row.id,'">' ,
                    '<i class="fas fa-trash"></i>',
                    '</a>'
                ].join('');
            }

            $(function(){
                $('input[name=color_code]').keypress(function(e){
                    var txt = String.fromCharCode(e.which);
                    console.log(txt + ' : ' + e.which);
                    if(!txt.match(/[A-Za-z0-9+_.]/)) 
                    {
                        return false;
                    }
                });
            });
        </script>
   
@endsection

@section('modals')
    <!-- Modal Add-->
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" action="{{route('color.add')}}" method="post">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Color</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Color Name</label>
                        <input type="text" class="form-control" name="color_name" placeholder="Green Tea" value="">
                    </div>

                    <div class="form-group">
                        <label>Color Code</label>
                        <input type="text" class="form-control" name="color_code" placeholder="green_tea" value="">
                    </div>

                    <div class="form-group">
                        <label>Color</label>
                        <input type="color" class="form-control colorpicker" name="color_hex" value="#000000" placeholder="Color" value="">
                        <small class="example-colorpicker">#000000</small>
                    </div>
                </div>
                <div class="modal-footer">
                <button class="btn btn-primary btn-block" type="submit">Add New Color</button>
                </div>
            </form>
        </div>
        </div>
    </div>

    <!-- Modal Edit-->
    @foreach ($data['color'] as $key=>$value)
    <div class="modal fade" id="edit-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form" action="{{route('color.edit', $value->id)}}" method="post">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Color {{$value->color_name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Color Name</label>
                        <input type="text" class="form-control" name="color_name" placeholder="Color Name" value="{{$value->color_name}}">
                    </div>

                    <div class="form-group">
                        <label>Color Code</label>
                        <input type="text" class="form-control" name="color_code" placeholder="Color Code" value="{{$value->color_code}}">
                    </div>

                    <div class="form-group">
                        <label>Color</label>
                        <input type="color" class="form-control colorpicker" name="color_hex" value="{{$value->color_hex}}" placeholder="Color" value="">
                        <small class="example-colorpicker">{{$value->color_hex}}</small>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-block">Save changes</button>
                </div>
            </form>
        </div>
        </div>
    </div>
    @endforeach

    <!-- Modal Delete-->
    @foreach ($data['color'] as $key=>$value)
    <div class="modal fade" id="delete-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete {{$value->color_name}}?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form class="form" action="{{route('color.delete', $value->id)}}" method="post">
                    @csrf
                    {{ method_field ('DELETE') }}
                    <div class="btn-group" style="width: 100%;">
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
    @endforeach
@endsection

