<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task Manager</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --danger: #e5383b;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background-color: #f5f7fb;
            color: var(--dark);
            position: relative;
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background: white;
            padding: 2rem 1rem;
            box-shadow: var(--shadow);
            display: flex;
            flex-direction: column;
            z-index: 100;
            transition: var(--transition);
        }

        .sidebar-header {
            padding: 0 1rem 2rem;
            border-bottom: 1px solid #eee;
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .sidebar-header h2 {
            color: var(--primary);
            font-size: 1.5rem;
        }

        .close-sidebar {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--gray);
            cursor: pointer;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 0.8rem 1rem;
            margin-bottom: 0.5rem;
            border-radius: 8px;
            color: var(--gray);
            text-decoration: none;
            transition: var(--transition);
        }

        .nav-item:hover {
            background-color: #eef2ff;
            color: var(--primary);
        }

        .nav-item.active {
            background-color: #e0e7ff;
            color: var(--primary);
            font-weight: 600;
        }

        .nav-item i {
            margin-right: 12px;
            font-size: 1.2rem;
            width: 24px;
            text-align: center;
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            padding: 2rem;
            position: relative;
            transition: var(--transition);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .header h1 {
            color: var(--primary);
            font-size: 2rem;
        }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--primary);
            cursor: pointer;
        }

        /* Task List Styles */
        .task-list {
            list-style: none;
        }

        .task-item {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            transition: transform 0.2s;
        }

        .task-item:hover {
            transform: translateY(-2px);
        }

        .task-info {
            flex: 1;
        }

        .task-title {
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }

        .task-status {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .status-completed {
            background-color: #e3f2fd;
            color: var(--success);
        }

        .status-pending {
            background-color: #fff8e1;
            color: #ff9800;
        }

        .task-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn {
            border: none;
            border-radius: 6px;
            padding: 0.5rem 1rem;
            cursor: pointer;
            font-weight: 500;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-icon {
            width: 36px;
            height: 36px;
            padding: 0;
            border-radius: 50%;
        }

        .btn-complete {
            background-color: #e8f5e9;
            color: #2e7d32;
        }

        .btn-edit {
            background-color: #e3f2fd;
            color: var(--primary);
        }

        .btn-delete {
            background-color: #ffebee;
            color: var(--danger);
        }

        .btn:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        /* Floating Action Button */
        .fab {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 60px;
            height: 60px;
            background-color: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow);
            text-decoration: none;
            font-size: 1.8rem;
            transition: var(--transition);
            z-index: 90;
        }

        .fab:hover {
            background-color: var(--secondary);
            transform: scale(1.05) translateY(-5px);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: var(--gray);
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            color: #e0e0e0;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .sidebar {
                position: fixed;
                left: 0;
                top: 0;
                height: 100%;
                transform: translateX(-100%);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .close-sidebar {
                display: block;
            }
            
            .menu-toggle {
                display: block;
            }
            
            .main-content {
                width: 100%;
                padding: 1.5rem;
            }
            
            .header {
                margin-bottom: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .task-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .task-actions {
                width: 100%;
                justify-content: flex-end;
            }
            
            .nav-item span {
                display: inline;
            }
        }

        @media (max-width: 480px) {
            .header h1 {
                font-size: 1.5rem;
            }
            
            .task-item {
                padding: 1.2rem;
            }
            
            .task-actions {
                gap: 0.3rem;
            }
            
            .btn-icon {
                width: 32px;
                height: 32px;
                font-size: 0.9rem;
            }
            
            .fab {
                width: 50px;
                height: 50px;
                font-size: 1.5rem;
                bottom: 1.5rem;
                right: 1.5rem;
            }
            
            .empty-state {
                padding: 2rem 1rem;
            }
            
            .empty-state i {
                font-size: 3rem;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <h2>Task Manager</h2>
            <button class="close-sidebar" aria-label="Close menu">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <nav class="nav-list">
            <a href="{{ route('tasks.index') }}" class="nav-item {{ request()->routeIs('tasks.index') ? 'active' : '' }}">
                <i class="fas fa-list-check"></i>
                <span>All Tasks</span>
            </a>
            <a href="{{ route('tasks.create') }}" class="nav-item {{ request()->routeIs('tasks.create') ? 'active' : '' }}">
                <i class="fas fa-plus-circle"></i>
                <span>Create Task</span>
            </a>
            {{-- Optional edit latest --}}
            @isset($latestTask)
            <a href="{{ route('tasks.edit', $latestTask) }}" class="nav-item">
                <i class="fas fa-cog"></i>
                <span>Edit Latest</span>
            </a>
            @endisset
            <a href="{{ route('logout') }}" class="nav-item"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <div class="header">
            <button class="menu-toggle" aria-label="Open menu">
                <i class="fas fa-bars"></i>
            </button>
            <h1>Your Tasks</h1>
        </div>

        <ul class="task-list">
            @if($tasks->count() > 0)
                @foreach ($tasks as $task)
                <li class="task-item">
                    <div class="task-info">
                        <div class="task-title">{{ $task->title }}</div>
                        <span class="task-status {{ $task->is_completed ? 'status-completed' : 'status-pending' }}">
                            {{ $task->is_completed ? '✅ Completed' : '🕒 Pending' }}
                        </span>
                    </div>
                    <div class="task-actions">
                        @if(!$task->is_completed)
                        <form action="{{ route('tasks.complete', $task) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-complete btn-icon" title="Mark Complete">✓</button>
                        </form>
                        @endif
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-edit btn-icon" title="Edit">✏️</a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete btn-icon" title="Delete" 
                                onclick="return confirm('Are you sure you want to delete this task?')">🗑️</button>
                        </form>
                    </div>
                </li>
                @endforeach
            @else
                <div class="empty-state">
                    <div>📭</div>
                    <h3>No tasks found</h3>
                    <p>Get started by creating a new task</p>
                </div>
            @endif
        </ul>
        
        <!-- Floating Action Button -->
        <a href="{{ route('tasks.create') }}" class="fab">+</a>
    </main>

    <script>
        // Toggle sidebar on mobile
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.querySelector('.menu-toggle');
            const closeSidebar = document.querySelector('.close-sidebar');
            const sidebar = document.querySelector('.sidebar');
            
            menuToggle.addEventListener('click', function() {
                sidebar.classList.add('active');
                document.body.style.overflow = 'hidden';
            });
            
            closeSidebar.addEventListener('click', function() {
                sidebar.classList.remove('active');
                document.body.style.overflow = '';
            });
            
            // Close sidebar when clicking outside
            document.addEventListener('click', function(event) {
                if (sidebar.classList.contains('active') && 
                    !sidebar.contains(event.target) && 
                    !menuToggle.contains(event.target)) {
                    sidebar.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });
        });
    </script>
</body>
</html>