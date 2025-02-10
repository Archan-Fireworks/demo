@extends('backend.layouts.app')

@section('content')

    <div class="row">
        @if(get_setting('nexmo') == 1)
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Nexmo Credential</h5>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('update_credentials') }}" method="POST">
                            <input type="hidden" name="otp_method" value="nexmo">
                            @csrf                
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="NEXMO_KEY">
                                <div class="col-lg-3">
                                    <label class="col-from-label">NEXMO KEY</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="NEXMO_KEY" value="{{ env('NEXMO_KEY') }}" placeholder="NEXMO KEY" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="NEXMO_SECRET">
                                <div class="col-lg-3">
                                    <label class="col-from-label">NEXMO SECRET</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="NEXMO_SECRET" value="{{ env('NEXMO_SECRET') }}" placeholder="NEXMO SECRET" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="NEXMO_SENDER_ID">
                                <div class="col-lg-3">
                                    <label class="col-from-label">NEXMO SENDER ID</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="NEXMO_SENDER_ID" value="{{ env('NEXMO_SENDER_ID') }}" placeholder="NEXMO SENDER ID" required="">
                                    <small>
                                    Please check this URL for
                                    <a href="https://developer.vonage.com/en/messaging/sms/guides/custom-sender-id?source=messaging">Sender Identity</a> 
                                    before setting the sender ID
                                    </small>
                                </div>
                            </div>
                            <div class="form-group mb-0 text-right">
                                <button type="submit" class="btn btn-sm btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
        @if(get_setting('twillo') == 1)
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Twilio Credential</h5>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('update_credentials') }}" method="POST">
                            <input type="hidden" name="otp_method" value="twillo">
                            @csrf                
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="TWILIO_SID">
                                <div class="col-lg-3">
                                    <label class="col-from-label">TWILIO SID</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="TWILIO_SID" value="{{ env('TWILIO_SID') }}" placeholder="TWILIO SID" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="TWILIO_AUTH_TOKEN">
                                <div class="col-lg-3">
                                    <label class="col-from-label">TWILIO AUTH TOKEN</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="TWILIO_AUTH_TOKEN" value="{{ env('TWILIO_AUTH_TOKEN') }}" placeholder="TWILIO AUTH TOKEN" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="VALID_TWILLO_NUMBER">
                                <div class="col-lg-3">
                                    <label class="col-from-label">VALID TWILIO NUMBER</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="VALID_TWILLO_NUMBER" value="{{ env('VALID_TWILLO_NUMBER') }}" placeholder="VALID TWILLO NUMBER">
                                </div>
                            </div>
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="TWILLO_TYPE">
                                <div class="col-lg-3">
                                    <label class="col-from-label">TWILIO TYPE</label>
                                </div>
                                <div class="col-lg-6">
                                    <select class="form-control" name="TWILLO_TYPE">
                                        <option value="1" @if(env('TWILLO_TYPE') == "1") selected @endif>SMS</option>
                                        <option value="2" @if(env('TWILLO_TYPE') == "2") selected @endif>WhatsApp</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-0 text-right">
                                <button type="submit" class="btn btn-sm btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
        @if(get_setting('ssl_wireless') == 1)
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">SSL Wireless Credential</h5>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('update_credentials') }}" method="POST">
                            <input type="hidden" name="otp_method" value="ssl_wireless">
                            @csrf                
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="SSL_SMS_API_TOKEN">
                                <div class="col-lg-3">
                                    <label class="col-from-label">SSL SMS API TOKEN</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="SSL_SMS_API_TOKEN" value="{{ env('SSL_SMS_API_TOKEN') }}" placeholder="SSL SMS API TOKEN" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="SSL_SMS_SID">
                                <div class="col-lg-3">
                                    <label class="col-from-label">SSL SMS SID</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="SSL_SMS_SID" value="{{ env('SSL_SMS_SID') }}" placeholder="SSL SMS SID" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="SSL_SMS_URL">
                                <div class="col-lg-3">
                                    <label class="col-from-label">SSL SMS URL</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="SSL_SMS_URL" value="{{ env('SSL_SMS_URL') }}" placeholder="SSL SMS URL">
                                </div>
                            </div>
                            <div class="form-group mb-0 text-right">
                                <button type="submit" class="btn btn-sm btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
        @if(get_setting('fast2sms') == 1)
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Fast2SMS Credential</h5>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('update_credentials') }}" method="POST">
                            <input type="hidden" name="otp_method" value="fast2sms">
                            @csrf                
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="AUTH_KEY">
                                <div class="col-lg-3">
                                    <label class="col-from-label">AUTH KEY</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="AUTH_KEY" value="{{ env('AUTH_KEY') }}" placeholder="AUTH KEY" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="ENTITY_ID">
                                <div class="col-lg-3">
                                    <label class="col-from-label">ENTITY ID</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="ENTITY_ID" value="{{ env('ENTITY_ID') }}" placeholder="ENTITY ID">
                                </div>
                            </div>
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="ROUTE">
                                <div class="col-lg-3">
                                    <label class="col-from-label">ROUTE</label>
                                </div>
                                <div class="col-lg-6">
                                    <select class="form-control aiz-selectpicker" name="ROUTE" required="">
                                        <option value="dlt_manual" @if(env('ROUTE') == "dlt_manual") selected @endif>DLT Manual</option>
                                        <option value="p" @if(env('ROUTE') == "p") selected @endif>Promotional Use</option>
                                        <option value="t" @if(env('ROUTE') == "t") selected @endif>Transactional Use</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="LANGUAGE">
                                <div class="col-lg-3">
                                    <label class="col-from-label">Language</label>
                                </div>
                                <div class="col-lg-6">
                                        <select class="form-control aiz-selectpicker" name="LANGUAGE" required="" tabindex="-98">
                                            <option value="english" @if(env('LANGUAGE') == "english") selected @endif>English</option>
                                            <option value="unicode" @if(env('LANGUAGE') == "unicode") selected @endif>Unicode</option>
                                        </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="SENDER_ID">
                                <div class="col-lg-3">
                                    <label class="col-from-label">SENDER ID</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="SENDER_ID" value="{{ env('SENDER_ID') }}" placeholder="6 digit SENDER ID">
                                </div>
                            </div>
                            <div class="form-group mb-0 text-right">
                                <button type="submit" class="btn btn-sm btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
        @if(get_setting('mimo') == 1)
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">MIMO Credential</h5>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('update_credentials') }}" method="POST">
                            <input type="hidden" name="otp_method" value="mimo">
                            @csrf                
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="MIMO_USERNAME">
                                <div class="col-lg-3">
                                    <label class="col-from-label">MIMO_USERNAME</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="MIMO_USERNAME" value="" placeholder="MIMO_USERNAME" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="MIMO_PASSWORD">
                                <div class="col-lg-3">
                                    <label class="col-from-label">MIMO_PASSWORD</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="MIMO_PASSWORD" value="" placeholder="MIMO_PASSWORD" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="MIMO_SENDER_ID">
                                <div class="col-lg-3">
                                    <label class="col-from-label">MIMO_SENDER_ID</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="MIMO_SENDER_ID" value="FSTSMS" placeholder="MIMO_SENDER_ID" required="">
                                </div>
                            </div>
                            <div class="form-group mb-0 text-right">
                                <button type="submit" class="btn btn-sm btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
        @if(get_setting('mimsms') == 1)
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">MIMSMS Credential</h5>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('update_credentials') }}" method="POST">
                            <input type="hidden" name="otp_method" value="mimsms">
                            @csrf                
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="MIM_API_KEY">
                                <div class="col-lg-3">
                                    <label class="col-from-label">MIM_API_KEY</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="MIM_API_KEY" value="12345" placeholder="MIM_API_KEY" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="MIM_SENDER_ID">
                                <div class="col-lg-3">
                                    <label class="col-from-label">MIM_SENDER_ID</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="MIM_SENDER_ID" value="12345" placeholder="MIM_SENDER_ID" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="MIM_BASE_URL">
                                <div class="col-lg-3">
                                    <label class="col-from-label">MIM_BASE_URL</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="MIM_BASE_URL" value="" placeholder="MIM_BASE_URL" required="">
                                </div>
                            </div>
                            <div class="form-group mb-0 text-right">
                                <button type="submit" class="btn btn-sm btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
        @if(get_setting('msegat') == 1)
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">MSEGAT Credential</h5>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('update_credentials') }}" method="POST">
                            <input type="hidden" name="otp_method" value="msegat">
                            @csrf                
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="MSEGAT_API_KEY">
                                <div class="col-lg-3">
                                    <label class="col-from-label">MSEGAT_API_KEY</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="MSEGAT_API_KEY" value="y" placeholder="MSEGAT_API_KEY" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="MSEGAT_USERNAME">
                                <div class="col-lg-3">
                                    <label class="col-from-label">MSEGAT_USERNAME</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="MSEGAT_USERNAME" value="y" placeholder="MSEGAT_USERNAME" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="MSEGAT_USER_SENDER">
                                <div class="col-lg-3">
                                    <label class="col-from-label">MSEGAT_USER_SENDER</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="MSEGAT_USER_SENDER" value="y" placeholder="MSEGAT_USER_SENDER" required="">
                                </div>
                            </div>
                            <div class="form-group mb-0 text-right">
                                <button type="submit" class="btn btn-sm btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
        @if(get_setting('sparrow') == 1)
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">SPARROW Credential</h5>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('update_credentials') }}" method="POST">
                            <input type="hidden" name="otp_method" value="sparrow">
                            @csrf                
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="SPARROW_TOKEN">
                                <div class="col-lg-3">
                                    <label class="col-from-label">SPARROW_TOKEN</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="SPARROW_TOKEN" value="" placeholder="SPARROW_TOKEN" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <input type="hidden" name="types[]" value="MESSGAE_FROM">
                                <div class="col-lg-3">
                                    <label class="col-from-label">MESSGAE_FROM</label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="MESSGAE_FROM" value="" placeholder="MESSGAE_FROM" required="">
                                </div>
                            </div>
                            <div class="form-group mb-0 text-right">
                                <button type="submit" class="btn btn-sm btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        function updateSettings(el, type){
            if($(el).is(':checked')){
                var value = 1;
            }
            else{
                var value = 0;
            }
            
            $.post('{{ route('business_settings.update.activation') }}', {_token:'{{ csrf_token() }}', type:type, value:value}, function(data){
                if(data == '1'){
                    AIZ.plugins.notify('success', '{{ translate('Settings updated successfully') }}');
                }
                else{
                    AIZ.plugins.notify('danger', 'Something went wrong');
                }
            });
        }
    </script>
@endsection
