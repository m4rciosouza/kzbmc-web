@extends( 'layout' )

@section( 'content' )
	<table>
	@foreach( $usuarios as $usuario )
        <tr>
        	<td>{{ $usuario->name }}</td>
        	<td>{{ $usuario->email }}</td>
        </tr>
    @endforeach
    </table>
    <p>{{ $outro }}</p>
    <table>
	@foreach( $canvas as $obj )
        <tr>
        	<td>{{ $obj->name }}</td>
        	<td>{{ $obj->description }}</td>
        </tr>
    @endforeach
    </table>
@stop