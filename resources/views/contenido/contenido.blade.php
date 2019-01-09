@extends('principal')
@section('contenido')
    
    @if(Auth::check())
        @if(Auth::user()->idrol == 1)
            <template v-if="menu==0">
                <desarrollos></desarrollos>
            </template>

            <template v-if="menu==1">
                <categoria></categoria>
            </template>

            <template v-if="menu==2">
                <subcategoria></subcategoria>
            </template>

            <!-- <template v-if="menu==3">
                <desarrollo></desarrollo>
            </template> -->

            <!-- <page v-if="page==1">
                <oneDesarrollo></oneDesarrollo>
            </page> -->

            <template v-if="menu==5">
                <nuevo></nuevo>
            </template>
            
            <template v-if="menu==6">
                <oneDesarrollo></oneDesarrollo>
            </template>

            <template v-if="menu==7">
                <user></user>
            </template> 
            <template v-if="menu==8">
                <role></role>
            </template>

        @elseif(Auth::user()->idrol == 2)

            <template v-if="menu==0">
                <desarrollos></desarrollos>
            </template>
            
            <page v-if="page==1">
                <oneDesarrollo></oneDesarrollo>
            </page>

           <!--  <template v-if="menu==3">
                <desarrollo></desarrollo>
            </template>
 -->
            <template v-if="menu==5">
                <nuevo></nuevo>
            </template>

            <template v-if="menu==6">
                <oneDesarrollo></oneDesarrollo>
            </template>
        @else
        
        @endif
    @endif

@endsection