
    <div class="col-md-3">
        <div class="list-group">
            @foreach ($users as $user)
                <a class="list-group-item" href="{{ route('conversations.show', $user->id) }}">
                    {{ ucfirst($user->name) }}
                    @if (isset($unread[$user->id]))
                        <span class="badge badge-pill badge-danger">{{ $unread[$user->id] }}</span>
                    @endif
                </a>
            @endforeach
        </div>
    </div>