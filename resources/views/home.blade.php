<?php
if(Auth::check())
{
    $variable = "layouts.original";
    if(Auth::user()->tipousuario_id==1)
    {
        $variable2 = "jumbotron.administrador";
    }
    elseif(Auth::user()->tipousuario_id==2)
    {
        $variable2 = "jumbotron.operario";
    }


}
else
{
    $variable = "layouts.login";
    $variable2="auth.porobligacion";
}

?>


@extends($variable)
@section('content')

    @include($variable2)


@endsection

