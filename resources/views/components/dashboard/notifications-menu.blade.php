      <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-bell"></i>
              <span class="badge badge-warning navbar-badge">{{ $unreadNotifications }}</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <span class="dropdown-header">{{ $unreadNotifications }} Notifications</span>
              <div class="dropdown-divider"></div>

              @foreach ($notifications as $notification)
                  <a href="{{ $notification->data['url'] }}?notification_id={{$notification->id}}"
                      class="dropdown-item @if ($notification->read_at === null) font-weight-bold @endif">
                      <i class="fas fa-envelope mr-2"></i> {{ $notification->data['body'] }}
                      <span
                          class="float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
                  </a>
              @endforeach



              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
      </li>
