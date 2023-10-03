@extends('layouts.backend')
@section('page-styles')
    <style>
        .message-bubble {
            max-width: 80%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .user-message {
            background-color: #f1f1f1;
            align-self: flex-start;
        }

        .admin-message {
            background-color: #e2f3ff;
            align-self: flex-end;
        }

        .custom-list-item {
            border: none !important;
            box-shadow: none !important;
            margin-bottom: 0.5rem;
        }
    </style>
@endsection
<!--  Body Wrapper -->
<!--  Header End -->
@section('content')
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">站內信</h5>
                    <!--<p class="mb-0">This is a sample page </p>-->
                </div>
                <ol class="list-group list-group-numbered">
                    @foreach ($chatHistory as $record)
                        
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto w-100">
                                <p>
                                    <a class="fw-bold" data-bs-toggle="collapse" href="#mail{{$record->id}}" role="button" aria-expanded="false" aria-controls="mail{{$record->id}}">
                                        {{$record->messages[0]->sender->email}}
                                        <small>{{$record->type}}</small>
                                    </a>
                                    <small class="text-end">{{$record->created_at}} </small>
                                </p>

                                <div class="collapse" id="mail{{$record->id}}">
                                    <div class="accordion-body mb-3">
                                        <div class="list-group overflow-auto h-50 w-100 bg-white">
                                            @foreach ($record->messages as $message)
                                                <div class="list-group-item custom-list-item mb-2">
                                                    <div
                                                        class="d-flex justify-content-{{ $message->recipient_id != null ? 'between' : 'end' }} pe-3">
                                                        <div
                                                            class="message-bubble {{ $message->recipient_id != null ? 'admin-message' : 'user-message text-end' }} ">
                                                            <p>{{ $message->content }}</p>
                                                            <small>{{ $message->created_at }}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <form method="POST"
                                            action="{{ route('admin.email_service.followMessage', ['ticket_id' => $record->id]) }}">
                                            @csrf
                                            <div class="mb-2">
                                                <textarea class="form-control" name="message" id="message" rows="4" placeholder="留言"></textarea>
                                            </div>
                                            
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-primary">發送</button>
                                            </div>
                                        </form>
                                    </div>



                                </div>
                            </div>
                            @if ($record->messages[count($record->messages) - 1]->recipient_id == null)
                                <span class="badge bg-primary rounded-pill">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                   <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                   <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                                 </svg>
                                </span>
                            @endif
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
@endsection


@section('page-scripts')
@stop
