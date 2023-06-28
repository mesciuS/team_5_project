@extends('layouts.app')
@section('content')
<div class="container pt-3 d-flex align-items-center flex-column">
  @if($house->user_id != $user_id)
  <span>Non puoi visualizzare questa casa!</span>
  @else
  <div class="card" style="width: 18rem;">
    <img src="{{asset('storage/'. $house->thumbnail)}}" class="card-img-top" alt="Immagine di copertina">
    <div class="card-body">
      <h5 class="card-title">{{$house->title}}</h5>
      @if($house->sponsorship)
      <i if class="fa-solid fa-star-of-david fa-spin"></i>
      @endif
      <p class="card-text">{{$house->description}}</p>
    </div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item">N° stanze: {{$house->rooms}}</li>
      <li class="list-group-item">N° bagni: {{$house->bathrooms}}</li>
      <li class="list-group-item">m&sup2;: {{$house->square_mt}}</li>
      <li class="list-group-item">Servizi: 
      @foreach ($house->services as $singleService)
        <i class="{{$singleService->icon}}"></i> {{$singleService->name}}
      @endforeach
      </li>
    </ul>
  </div>
  
  @foreach($images as $singleImage)
  
  <img src="http://127.0.0.1:8000/{{$singleImage->path}}" class="w-25" alt="img">
  <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#modalMessageDelete">
    Elimina foto
  </button>
  <div class="modal fade" id="modalMessageDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Sei sicuro di voler eliminare la foto?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&Chi;</span>
          </button>
        </div>
        <div class="modal-body">
          Attenzione! L'azione sarà irreversibile.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Torna indietro</button>
          <form action="{{route('image.destroy', $singleImage->id)}}" method="POST">
            @csrf
            @method('DELETE')
  
            <button class="btn btn-danger" type="submit">Elimina</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endforeach
  <hr>
  <button class="btn btn-secondary mb-3"><a href="{{route('houses.edit', $house)}}" class="link-light">Modifica la tua casa</a></button>
  <button class="btn btn-secondary mb-3"><a href="{{route('sponsorship.index', $house)}}" class="link-light">Sponsorizza</a></button>
  <button class="btn btn-secondary mb-3"><a href="{{route('welcome', $house)}}" class="link-light">Indietro</a></button>
  <button class="btn btn-secondary mb-3"><a href="{{route('image.create', $house)}}" class="link-light">Aggiungi foto</a></button>

  <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
    Elimina casa
  </button>
  @endif
  @foreach ($messages as $message)
  <div class="message ">
    <div class="alert mt-2 {{($message->read) ? 'alert-dark' : 'alert-success'}}" role="alert">
      <h4 style="display :{{($message->read) ? 'none' : 'block'}};" class="alert-heading">Nuovo messaggio!</h4>
      <p style="{{($message->read) ? 'alert-dark' : 'alert-success'}}"></p>
      <p>{{$message->text}}</p>
      <hr>
      <p class="mb-0">Da: {{$message->email}}</p>
      <form action="{{ route('messages.update', $message->id)}}" method="POST">
        @csrf
        @method('PUT')
        <button class="mt-2" type="submit">Segna come letto</button>
      </form>
      <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#modalMessageDelete">
        Elimina messaggio
      </button>
      <div class="modal fade" id="modalMessageDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Sei sicuro di voler eliminare il messaggio?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&Chi;</span>
              </button>
            </div>
            <div class="modal-body">
              Attenzione! L'azione sarà irreversibile.
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Torna indietro</button>
              <form action="{{route('messages.destroy', $message->id)}}" method="POST">
                @csrf
                @method('DELETE')
      
                <button class="btn btn-danger" type="submit">Elimina</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>

    {{-- Modal --}}

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Sei sicuro di voler eliminare la casa?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&Chi;</span>
        </button>
      </div>
      <div class="modal-body">
        Attenzione! L'azione sarà irreversibile.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Torna indietro</button>
        <form action="{{route('houses.destroy', $house)}}" method="POST">
          @csrf
          @method('DELETE')

          <button class="btn btn-danger" type="submit">Elimina</button>
      </form>
      </div>
    </div>
  </div>
</div>
@endsection