<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Task</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --danger: #e5383b;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --radius: 8px;
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
            border-radius: var(--radius);
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
            display: flex;
            flex-direction: column;
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

        .back-link-mobile {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--gray);
            cursor: pointer;
            margin-right: 1rem;
        }

        /* Form Styles */
        .form-container {
            max-width: 600px;
            width: 100%;
            margin: 0 auto;
        }

        .form-card {
            background: white;
            border-radius: var(--radius);
            padding: 2rem;
            box-shadow: var(--shadow);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--dark);
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #ddd;
            border-radius: var(--radius);
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
        }

        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }

        .btn {
            border: none;
            border-radius: var(--radius);
            padding: 0.75rem 1.5rem;
            cursor: pointer;
            font-weight: 500;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-secondary {
            background-color: #e9ecef;
            color: var(--dark);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .btn-primary:hover {
            background-color: var(--secondary);
        }

        .btn-secondary:hover {
            background-color: #dde0e3;
        }

        .btn i {
            margin-right: 8px;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        /* Back Link */
        .back-link {
            display: inline-flex;
            align-items: center;
            color: var(--gray);
            text-decoration: none;
            margin-top: 1.5rem;
            transition: color 0.3s;
        }

        .back-link:hover {
            color: var(--primary);
        }

        .back-link i {
            margin-right: 6px;
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
            
            .back-link-mobile {
                display: block;
            }
        }

        @media (max-width: 768px) {
            .action-buttons {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
            
            .form-card {
                padding: 1.5rem;
            }
            
            .header h1 {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .header h1 {
                font-size: 1.3rem;
            }
            
            .form-container {
                padding: 0;
            }
            
            .form-card {
                padding: 1.2rem;
            }
            
            .back-link {
                display: none;
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
            <div>
                <button class="menu-toggle" aria-label="Open menu">
                    <i class="fas fa-bars"></i>
                </button>
                <button class="back-link-mobile" onclick="window.history.back()" aria-label="Go back">
                    <i class="fas fa-arrow-left"></i>
                </button>
            </div>
            <h1>Add New Task</h1>
        </div>

        <div class="form-container">
            <form method="POST" action="{{ route('tasks.store') }}" class="form-card">
                @csrf
                
                <div class="form-group">
                    <label for="title" class="form-label">Title</label>
                    <input 
                        type="text" 
                        id="title" 
                        name="title" 
                        class="form-control" 
                        placeholder="Enter task title" 
                        required
                    >
                </div>
                
                <div class="form-group">
                    <label for="description" class="form-label">Description</label>
                    <textarea 
                        id="description" 
                        name="description" 
                        class="form-control" 
                        placeholder="Enter task details"
                    ></textarea>
                </div>
                
                <div class="action-buttons">
                    <button type="submit" class="btn btn-primary">
                        <i>💾</i> Save Task
                    </button>
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
                        <i>↩️</i> Cancel
                    </a>
                </div>
            </form>
            
            <a href="{{ route('tasks.index') }}" class="back-link">
                <i>⬅️</i> Back to Task List
            </a>
        </div>
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