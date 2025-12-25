@extends('layouts.app')

@section('title', 'My Results')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-11 col-lg-10">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white py-3">
                <h4 class="mb-0">
                    <i class="bi bi-trophy-fill"></i> My Quiz Results
                </h4>
            </div>
            <div class="card-body p-4">
                @if($scores->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-primary">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Score</th>
                                    <th class="text-center">Total</th>
                                    <th>Percentage</th>
                                    <th>Grade</th>
                                    <th>Date Taken</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($scores as $i => $s)
                                    @php
                                        $percentage = ($s->score / $s->total) * 100;
                                        $gradeClass = $percentage >= 80 ? 'success' : ($percentage >= 60 ? 'warning' : 'danger');
                                        $gradeText = $percentage >= 80 ? 'Excellent' : ($percentage >= 60 ? 'Good' : 'Need Improvement');
                                        $gradeIcon = $percentage >= 80 ? 'emoji-smile' : ($percentage >= 60 ? 'emoji-neutral' : 'emoji-frown');
                                    @endphp
                                    <tr>
                                        <td class="text-center fw-bold">{{ ($scores->currentPage() - 1) * $scores->perPage() + $i + 1 }}</td>
                                        <td class="text-center">
                                            <h5 class="mb-0"><span class="badge bg-primary">{{ $s->score }}</span></h5>
                                        </td>
                                        <td class="text-center">
                                            <h5 class="mb-0"><span class="badge bg-secondary">{{ $s->total }}</span></h5>
                                        </td>
                                        <td>
                                            <div class="progress" style="height: 30px;">
                                                <div class="progress-bar bg-{{ $gradeClass }} fw-bold" 
                                                     role="progressbar" 
                                                     style="width: {{ $percentage }}%"
                                                     aria-valuenow="{{ $percentage }}" 
                                                     aria-valuemin="0" 
                                                     aria-valuemax="100">
                                                    {{ number_format($percentage, 1) }}%
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $gradeClass }} fs-6">
                                                <i class="bi bi-{{ $gradeIcon }}"></i> {{ $gradeText }}
                                            </span>
                                        </td>
                                        <td>
                                            <i class="bi bi-calendar-event text-primary"></i> 
                                            {{ $s->date_taken->format('M d, Y') }}
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
                        {{ $scores->links('pagination::bootstrap-5') }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-clipboard-x display-1 text-muted"></i>
                        <h4 class="mt-4 text-muted">No Results Yet</h4>
                        <p class="text-muted">You haven't taken any quizzes yet. Start your first quiz now!</p>
                        <a href="{{ route('quiz.show') }}" class="btn btn-primary btn-lg mt-3">
                            <i class="bi bi-pencil-square"></i> Take Your First Quiz
                        </a>
                    </div>
                @endif

                <div class="text-center mt-4">
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-lg">
                        <i class="bi bi-arrow-left"></i> Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection