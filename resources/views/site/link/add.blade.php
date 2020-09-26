<div class="container">
    <form method="POST" action="{{ route('save.link') }}" class="d-flex flex-column" id="links-add-form">
        @csrf
        <h4 class="form-header my-2 col-12">
            {{__("Add Link")}}
        </h4>

        <div class="d-flex flex-md-row flex-column">
            <div class="form-group field col-6">
                <input type="text" class="form-control @error('original') is-invalid @enderror" id="name"
                       name="original" required
                       placeholder="Original Link"
                       value="{{ old('name') }}"
                >
                @error('original')
                <div class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>
            <div class="col-md-6 col-6">
                <button type="submit" class="btn btn-primary">
                    {{__('Add Links')}}
                </button>
            </div>
        </div>
    </form>
</div>
