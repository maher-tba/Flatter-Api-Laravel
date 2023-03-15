<table class="table table-striped">
    <thead>
    <tr>
        <th class="text-center" scope="col">الناشر</th>
        <th class="text-center" scope="col">المهمة</th>
        <th class="text-center" scope="col">صاحب المهمة</th>
        <th class="text-center" scope="col"></th>
    </tr>
    </thead>
    @foreach ($tasks as $task)
        <tr>
            <td class="text-center" >
                {{ $task->author }}
            </td>
            <td class="text-center" >
                @if ($task->is_complete)
                    <s>{{ $task->title }}</s>
                @else
                    {{ $task->title }}
                @endif
            </td>
            {{--                                    todo--}}
            {{--                                    fixed performance issue extra query not needed                                  --}}
            <td class="text-center" >
                {{ $task->user->name }}
            </td>
            <td class="text-right">
                <div class="row float-end">
                    <div class="col-sm-4">
                        @if (! $task->is_complete)
                            <form method="POST" action="{{ route('user.tasks.update', $task->id) }}">
                                @csrf
                                @method('PUT')
                                <button type="submit" class=" btn btn-success btn-sm text-white"><strong >انجزت</strong></button>
                            </form>
                        @endif
                    </div>
                    @can('update',$task)
                        <div class="col-sm-4">
                            <form method="POST" action="{{ route('user.tasks.edit', $task->id) }}">
                                @csrf
                                @method('GET')
                                <button type="submit" class=" btn btn-info btn-sm text-white"><strong >تحرير</strong></button>
                            </form>
                        </div>
                    @endcan
                    @can('delete',$task)
                        <div class="col-sm-4">
                            <form method="POST" action="{{ route('user.tasks.destroy', $task->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class=" btn btn-danger btn-sm text-white "><strong >حذف</strong></button>
                            </form>
                        </div>
                    @endcan
                </div>

            </td>
        </tr>
    @endforeach
</table>
