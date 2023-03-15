<div class="card card-new-task">
    <div class="card-header">  <strong>مهمة جديدة</strong> </div>

    <div class="card-body">
        <form method="POST" action="{{ route('user.tasks.store') }}">
            @csrf
            <div class="form-group">
                <label for="title"> المهمة</label>
                <input id="title" name="title" type="text" maxlength="255" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" autocomplete="off" />
                @if ($errors->has('title'))
                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                @endif

            </div>
            @can('create')
                <button type="submit" class="btn btn-primary mt-3">انشاء</button>
            @endcan
        </form>
    </div>
</div>
