@extends('layouts.users')

@section('page-styles')
    <link rel="stylesheet" href="{{ asset('css/user-inventory.css') }}">
    <style>
        .message-bubble {
            max-width: 80%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .user-message {
            background-color: #e2f3ff;
            align-self: flex-start;
        }

        .admin-message {
            background-color: #f1f1f1;
            align-self: flex-end;
        }

        .custom-list-item {
            border: none !important;
            box-shadow: none !important;
            margin-bottom: 0.5rem;
        }
    </style>
@endsection

@section('content')

    <img src="{{ asset('img/個人中心.png') }}" width="100%" alt="">
    <div class="list-container" style="height: 86%">
        <ul>
            <div class="row mb-4">
                <div class="col-5">
                    <div class="box">
                        <span>{{ auth('users')->user()->name ?? '賬號' }}</span>
                    </div>
                </div>
                <div class="col-7">
                    <div class="box d-flex justify-content-between align-items-center p-3 bg-light rounded">
                        <span>$ {{ auth('users')->user()->wallet->balance ?? '錢包' }}</span>
                        <a href="" data-bs-toggle="modal" data-bs-target="#transferModal"
                            class="d-flex align-items-center text-decoration-none"><svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="bi bi-envelope-fill"
                                style="width: 24px; height: 24px;">
                                <path
                                    d="M3 4h18a1 1 0 0 1 1 1v11a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1zm1.462 1.226L12 10.292l7.538-4.066A2 2 0 0 1 21 7.096V17a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7.096a2 2 0 0 1 .462-1.87z" />
                            </svg></a>
                    </div>
                    <!-- 转账模态框 -->
                    <div class="modal fade" id="transferModal" tabindex="-1" aria-labelledby="transferModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="transferModalLabel">入账</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('userDetails.bankIn') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="receiver">銀行代碼及賬戶號碼</label>
                                            <input type="text" class="form-control" name="receiver"
                                                placeholder="输入銀行代碼及賬戶號碼" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="amount">金額</label>
                                            <input type="text" class="form-control" name="amount" placeholder="输入转账金额"
                                                required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">确认转账</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <li>
                <span>提款 </span>
                <div class="button_section">
                    <button class="details-btn" type="button" data-bs-toggle="collapse" data-bs-target="#withdrawalDetails"
                        aria-expanded="false" aria-controls="withdrawalDetails">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                            <path
                                d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                        </svg>
                    </button>
                </div>
            </li>

            <!-- Withdrawal Details Box -->
            <div class="collapse" id="withdrawalDetails">
                <div class="card card-body mb-3">
                    <p>請輸入提款金額以及賬戶資訊: </p>
                    <div class="overflow-auto h-50 w-100 bg-white list-group">
                        <form method="POST" action="{{ route('userDetails.withDraw') }}">
                            @csrf
                            <div class="list-group-item">
                                <div class="form-floating mt-2 mb-3">
                                    <input type="text" class="form-control" id="withdrawalAmount" name="withdrawalAmount"
                                        placeholder="請輸入提款金額" required>
                                    <label for="withdrawalAmount">提款金額</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="accountInfo" name="accountInfo"
                                        placeholder="請輸入帳戶資訊" required>
                                    <label for="accountInfo">銀行代碼及賬戶號碼</label>
                                </div>
                                <div class="button_section mt-3 mb-3">
                                    <button type="submit" class="btn btn-primary">確認</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>




            <li>
                <span>客服聯係 </span>
                <div class="button_section">
                    <button class="details-btn " type="button" data-bs-toggle="collapse" data-bs-target="#userDetails2"
                        aria-expanded="false" aria-controls="userDetails2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                            <path
                                d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                        </svg>
                    </button>
                </div>
            </li>
            <!-- DetailsBox -->
            <div class="collapse" id="userDetails2">
                <div class="card card-body mb-3">
                    <p>請在下方填寫您的問題或留言，並點擊發送。</p>
                    <form method="POST" action="{{ route('userDetails.sendMessage') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="type" class="form-label">問題類型</label>
                            <select class="form-select" name="type" id="type">
                                <option value="票務需求">票務需求</option>
                                <option value="存款問題">存款問題</option>
                                <option value="取款問題">取款問題</option>
                                <option value="其他">其他</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">留言</label>
                            <textarea class="form-control" name="message" id="message" rows="4"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary float-end">發送</button>
                    </form>
                    <!-- 历史记录 -->
                    <div class="card card-body mt-2">
                        <h5 class="mb-2">歷史記錄</h5>
                        @foreach ($chatHistory as $record)
                            <div class="accordion mb-2" id="accordion{{ $record->id }}">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $record->id }}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $record->id }}" aria-expanded="false"
                                            aria-controls="collapse{{ $record->id }}">
                                            <p>{{ $record->type }}</p>
                                            <small>{{ $record->created_at }}</small>
                                            <span class="accordion-button-icon"></span>
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $record->id }}" class="accordion-collapse collapse"
                                        aria-labelledby="heading{{ $record->id }}"
                                        data-bs-parent="#accordion{{ $record->id }}">
                                        <div class="accordion-body mb-3">
                                            <div class="list-group overflow-auto h-50 w-100 bg-white">
                                                @foreach ($record->messages as $message)
                                                    <div class="list-group-item custom-list-item">
                                                        <div
                                                            class="d-flex justify-content-{{ $message->recipient_id != null ? 'end' : 'between' }} pe-3">
                                                            <div
                                                                class="message-bubble {{ $message->recipient_id != null ? 'admin-message text-end' : 'user-message' }} ">
                                                                <p>{{ $message->content }}</p>
                                                                <small>{{ $message->created_at }}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <form method="POST"
                                                action="{{ route('userDetails.sendFollowUpMessage', ['message_id' => $record->id]) }}">
                                                @csrf
                                                <div class="mb-2">
                                                    <label for="message" class="form-label">留言</label>
                                                    <textarea class="form-control" name="message" id="message" rows="4"></textarea>
                                                </div>
                                                <div class="text-end">
                                                    <button type="submit" class="btn btn-primary">發送</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <li>
                <span>售票明細 </span>
                <div class="button_section">
                    <button class="details-btn" type="button" data-bs-toggle="collapse" data-bs-target="#userDetails3"
                        aria-expanded="false" aria-controls="userDetails3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                            <path
                                d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                        </svg>
                    </button>
                </div>
            </li>
            <!-- DetailsBox -->
            <div class="collapse " id="userDetails3">
                <div class="card card-body mb-3">
                    <p>以下是所有售票明细的信息：</p>
                    <ul class="overflow-auto h-50 w-100 bg-white">
                        @foreach ($tickets as $ticket)
                            <li>
                                <span>售票明细 : {{ $ticket->ticket->flight->departure_location }} 到
                                    {{ $ticket->ticket->flight->destination }}</span>
                                <div class="button_section">
                                    <button class="details-btn" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flightDetails{{ $ticket['ticket_id'] }}" aria-expanded="false"
                                        aria-controls="flightDetails{{ $ticket['ticket_id'] }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                                            <path
                                                d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                                        </svg>
                                    </button>

                                </div>
                            </li>
                            <!-- DetailsBox -->
                            <div class="collapse" id="flightDetails{{ $ticket['ticket_id'] }}">
                                <div class="card card-body mb-3">
                                    <li>狀態：{{  \App\Models\OwnedTicket::$statusLabels[$ticket->status] }} </li>
                                    <li>票价：{{ $ticket->ticket->price }}</li>
                                    <li>起飛地點：{{ $ticket->ticket->flight->departure_location }}</li>
                                    <li>抵達地點：{{ $ticket->ticket->flight->destination }} </li>
                                </div>
                            </div>
                        @endforeach
                    </ul>
                    <p class="text-end">如有任何问题，请联系客服。</p>
                </div>
            </div>



            <li>
                <span>提款明細 </span>
                <div class="button_section">
                    <button class="details-btn " type="button" data-bs-toggle="collapse" data-bs-target="#userDetails4"
                        aria-expanded="false" aria-controls="userDetails4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                            <path
                                d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                        </svg>
                    </button>
                </div>
            </li>
            <!-- DetailsBox -->
            <div class="collapse" id="userDetails4">
                <div class="card card-body mb-3">
                    <h4>提款明细内容</h4>
                    <ul class="overflow-auto h-50 w-100 bg-white">
                        @foreach ($walletHistory as $wallet)
                            <li>
                                <span>提款日期 {{ $wallet->created_at }} 提款金额: $ {{ $wallet->amount }}</span>
                                <div class="button_section">
                                    <button class="details-btn" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#withdrawDetails{{ $wallet->id }}" aria-expanded="false"
                                        aria-controls="withdrawDetails{{ $wallet->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                                            <path
                                                d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                                        </svg>
                                    </button>
                                </div>
                            </li>
                            <!-- DetailsBox -->
                            <div class="collapse" id="withdrawDetails{{ $wallet->id }}">
                                <div class="card card-body mb-3">
                                    <ul class="overflow-auto h-50 w-100 bg-white">
                                        <li>提款金额：${{ $wallet->amount }}</li>
                                        <li>申请提款日：{{ $wallet->created_at }}</li>
                                        <li>提款状态：{{ \App\Models\WalletDepositHistory::$statusLabels[$wallet->status] }}
                                        </li>
                                        <li>银行代码及账户：{{ $wallet->bank_code_account_number }}</li>
                                        <li>备注：{{ $wallet->remarks }}</li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </ul>
                    <p class="text-end">如有任何问题，请联系客服。</p>
                </div>
            </div>


        </ul>
    </div>
@endsection

@section('page-scripts')
    <script>
        $('.details-btn').click(function() {
            $(this).toggleClass('active');
        });
    </script>
@stop
