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
@stop