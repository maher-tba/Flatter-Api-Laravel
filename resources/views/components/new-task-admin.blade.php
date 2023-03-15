<div class="card card-new-task">
    <div class="card-header"> <strong>مهمة جديدة</strong> </div>

    <div class="card-body">

        <form method="POST" action="{{ route('admin.tasks.store') }}">
            @csrf
            <div class="row">
                <div class="form-group col-lg-8">
                    <label for="title"> المهمة</label>
                    <input id="title" name="title" type="text" maxlength="255" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" autocomplete="off" />
                    @if ($errors->has('title'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                    @endif
                </div>
                <div class="col-lg-4">
                    <label for="title"> المستخدم</label>
                    <select class="form-control" name="user_id" id="user_id">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{$user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">انشاء</button>
        </form>
    </div>
</div>
