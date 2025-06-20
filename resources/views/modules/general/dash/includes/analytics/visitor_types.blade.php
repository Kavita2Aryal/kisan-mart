<div class="card" style="min-height: 165px;">
    <div class="card-header">
        <div class="card-title full-width">
            Visitor Types
        </div>
    </div>
    <div class="card-body p-t-15">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-3 col-xlg-2">
                <img src="{{ asset('assets/img/cms-icons/general/visitortype.svg') }}" alt="visitor type" width="60">
            </div>
            <div class="col-sm-12 col-md-8 col-lg-9 col-xlg-10">
                @forelse ($user_types as $type => $session)
                <p class="font-montserrat fs-18 text-capitalize">
                    {{ $type }}: &nbsp;{{ number_format($session, 0, '', ',') }}
                </p>
                @empty
                @endforelse
                <small class="font-montserrat fs-18 m-b-0">
                    - From last 30 days
                </small>
            </div>
        </div>
    </div>
</div>