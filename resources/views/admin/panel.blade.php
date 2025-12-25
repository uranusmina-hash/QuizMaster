@extends('layouts.app')

@section('title', 'Admin Panel')

@section('content')
<div class="card shadow-lg border-0">
    <div class="card-header bg-primary text-white py-3">
        <h4 class="mb-0">
            <i class="bi bi-gear-fill"></i> Admin Panel
        </h4>
    </div>
    <div class="card-body p-4">
        @if($tab !== 'edit_question' || !$editQuestion)
            <ul class="nav nav-pills mb-4" role="tablist">
                <li class="nav-item me-2">
                    <a class="nav-link {{ $tab == 'add_question' ? 'active' : '' }}" href="{{ route('admin.panel', ['tab' => 'add_question']) }}">
                        <i class="bi bi-plus-circle"></i> Add Question
                    </a>
                </li>
                <li class="nav-item me-2">
                    <a class="nav-link {{ $tab == 'existing_questions' ? 'active' : '' }}" href="{{ route('admin.panel', ['tab' => 'existing_questions']) }}">
                        <i class="bi bi-list-ul"></i> Questions ({{ $questions->total() }})
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $tab == 'student_scores' ? 'active' : '' }}" href="{{ route('admin.panel', ['tab' => 'student_scores']) }}">
                        <i class="bi bi-people-fill"></i> Student Scores
                    </a>
                </li>
            </ul>
        @endif

        @if($tab == 'add_question')
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-primary">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="bi bi-plus-circle-fill text-primary"></i> Add New Question</h5>
                        </div>
                        <div class="card-body p-4">
                            <form method="POST" action="{{ route('admin.questions.store') }}">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Question</label>
                                    <textarea class="form-control" name="question" rows="3" required></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Option 1</label>
                                        <input type="text" class="form-control" name="option1" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Option 2</label>
                                        <input type="text" class="form-control" name="option2" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Option 3</label>
                                        <input type="text" class="form-control" name="option3" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Option 4</label>
                                        <input type="text" class="form-control" name="option4" required>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Correct Answer</label>
                                    <select class="form-select form-select-lg" name="answer" required>
                                        <option value="">Select correct answer</option>
                                        <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
                                        <option value="3">Option 3</option>
                                        <option value="4">Option 4</option>
                                    </select>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-plus-circle"></i> Add Question
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        @elseif($tab == 'edit_question' && $editQuestion)
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-warning">
                        <div class="card-header bg-warning">
                            <h5 class="mb-0"><i class="bi bi-pencil-square"></i> Edit Question</h5>
                        </div>
                        <div class="card-body p-4">
                            <form method="POST" action="{{ route('admin.questions.update', $editQuestion->id) }}">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Question</label>
                                    <textarea class="form-control" name="question" rows="3" required>{{ $editQuestion->question }}</textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Option 1</label>
                                        <input type="text" class="form-control" name="option1" value="{{ $editQuestion->option1 }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Option 2</label>
                                        <input type="text" class="form-control" name="option2" value="{{ $editQuestion->option2 }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Option 3</label>
                                        <input type="text" class="form-control" name="option3" value="{{ $editQuestion->option3 }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Option 4</label>
                                        <input type="text" class="form-control" name="option4" value="{{ $editQuestion->option4 }}" required>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Correct Answer</label>
                                    <select class="form-select form-select-lg" name="answer" required>
                                        <option value="1" {{ $editQuestion->answer == 1 ? 'selected' : '' }}>Option 1</option>
                                        <option value="2" {{ $editQuestion->answer == 2 ? 'selected' : '' }}>Option 2</option>
                                        <option value="3" {{ $editQuestion->answer == 3 ? 'selected' : '' }}>Option 3</option>
                                        <option value="4" {{ $editQuestion->answer == 4 ? 'selected' : '' }}>Option 4</option>
                                    </select>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-warning btn-lg">
                                        <i class="bi bi-check-circle"></i> Update Question
                                    </button>
                                    <a href="{{ route('admin.panel', ['tab' => 'existing_questions']) }}" class="btn btn-secondary btn-lg">
                                        <i class="bi bi-x-circle"></i> Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        @elseif($tab == 'existing_questions')
            @if($questions->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center" width="50">#</th>
                                <th>Question</th>
                                <th class="text-center" width="100">Answer</th>
                                <th class="text-center" width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($questions as $i => $q)
                                <tr>
                                    <td class="text-center fw-bold">{{ ($questions->currentPage() - 1) * $questions->perPage() + $i + 1 }}</td>
                                    <td>
                                        <strong>{{ $q->question }}</strong>
                                        <div class="mt-2 small text-muted">
                                            <div><span class="badge bg-secondary me-1">A</span> {{ $q->option1 }}</div>
                                            <div><span class="badge bg-secondary me-1">B</span> {{ $q->option2 }}</div>
                                            <div><span class="badge bg-secondary me-1">C</span> {{ $q->option3 }}</div>
                                            <div><span class="badge bg-secondary me-1">D</span> {{ $q->option4 }}</div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-success fs-6">Option {{ $q->answer }}</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.panel', ['edit_id' => $q->id, 'tab' => 'existing_questions']) }}" 
                                           class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.questions.delete', $q->id) }}" 
                                              class="d-inline" onsubmit="return confirm('Delete this question?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $questions->appends(['tab' => 'existing_questions'])->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-inbox display-1 text-muted"></i>
                    <h4 class="mt-3 text-muted">No Questions Yet</h4>
                    <a href="{{ route('admin.panel', ['tab' => 'add_question']) }}" class="btn btn-primary btn-lg mt-3">
                        <i class="bi bi-plus-circle"></i> Add First Question
                    </a>
                </div>
            @endif

        @elseif($tab == 'student_scores')
            @if($scores->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Username</th>
                                <th>Full Name</th>
                                <th class="text-center">Score</th>
                                <th class="text-center">Total</th>
                                <th>Percentage</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($scores as $i => $s)
                                @php
                                    $percentage = ($s->score / $s->total) * 100;
                                    $gradeClass = $percentage >= 80 ? 'success' : ($percentage >= 60 ? 'warning' : 'danger');
                                @endphp
                                <tr>
                                    <td class="text-center fw-bold">{{ ($scores->currentPage() - 1) * $scores->perPage() + $i + 1 }}</td>
                                    <td><i class="bi bi-person-circle text-primary"></i> {{ $s->user->username }}</td>
                                    <td>{{ $s->user->full_name }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-primary fs-6">{{ $s->score }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-secondary fs-6">{{ $s->total }}</span>
                                    </td>
                                    <td>
                                        <div class="progress" style="height: 25px;">
                                            <div class="progress-bar bg-{{ $gradeClass }} fw-bold" 
                                                 style="width: {{ $percentage }}%">
                                                {{ number_format($percentage, 1) }}%
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <i class="bi bi-calendar-event"></i> {{ $s->date_taken->format('M d, Y') }}
                                        <br>
                                        <small class="text-muted">
                                            <i class="bi bi-clock"></i> {{ $s->date_taken->format('h:i A') }}
                                        </small>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $scores->appends(['tab' => 'student_scores'])->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-clipboard-data display-1 text-muted"></i>
                    <h4 class="mt-3 text-muted">No Scores Yet</h4>
                    <p class="text-muted">No students have taken any quizzes yet.</p>
                </div>
            @endif
        @endif

        <div class="text-center mt-4">
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-lg">
                <i class="bi bi-arrow-left"></i> Back to Dashboard
            </a>
        </div>
    </div>
</div>
@endsection