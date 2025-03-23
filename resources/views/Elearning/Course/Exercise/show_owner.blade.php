@extends('BackEnd.Layout.base')
@section('title')
@section('title', $exercise->title)
@section('content')
    <div class="card m-4 px-4 shadow-lg col-lg-10" style="background-color: #fFfFfE">
        <div class="p-4 m-4">

            @if ($tfQuestions || $mcQuestions || $bsQuestions)
                @php
                    $part = 1;
                @endphp

                @if ($tfQuestions?->count() > 0)

                    <div class="alert alert-outline-primary border-0" role="alert">
                        <h4 class="text-decoration-underline">
                            <strong>Part {{ $part }}:</strong> Say True if the statement is correct or False if the
                            statement is
                            wrong
                        </h4>
                    </div>
                    @foreach ($tfQuestions as $tf)
                        <div class="d-flex align-items-center">
                            <p class="col-10  mx-2">{{ $loop->index + 1 }}. {{ $tf->question }}</p>
                            <div class="col-2">
                                <label class="visually-hidden" for="inlineFormSelectPref">Answer</label>
                                <span class="strong text-lg font-14 font-weight-bold text-decoration-underline">Answer:
                                    {{ $tf->exercise_answer->exercise_option->content }}</span>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                    @php
                        $part += 1;
                    @endphp
                @endif
                @if ($mcQuestions?->count() > 0)
                    <div class="alert alert-outline-primary border-0" role="alert">
                        <h4 class="text-decoration-underline">
                            <strong>Part {{ $part }}:</strong> Choice the best answer
                        </h4>
                    </div>
                    @foreach ($mcQuestions as $tff)
                        <div class="flex-col align-items-center my-1">
                            <p class="col-10  mt-3 mx-2">{{ $loop->index + 1 }}. {{ $tff->question }}</p>
                            <div class="col-md-10 mx-auto">
                                @foreach ($tff->exercise_options as $opt)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="{{ $tff->id }}"
                                            id="{{ $opt->id }}" value="{{ $tff->id }}">
                                        <label class="form-check-label" for="{{ $opt->id }}">
                                            {{ $opt->content }}
                                        </label>
                                    </div>
                                @endforeach

                            </div>

                        </div>
                        <hr>
                    @endforeach
                    @php
                        $part += 1;
                    @endphp
                @endif
                @if ($bsQuestions?->count() > 0)
                    <div class="alert alert-outline-primary border-0" role="alert">
                        <h4 class="text-decoration-underline">
                            <strong>Part {{ $part }}:</strong> Fill the blank space
                        </h4>
                    </div>
                    @foreach ($bsQuestions as $bss)
                        <div class="flex-col  my-1">
                            <p class="col-10 mx-2">{{ $loop->index + 1 }}. {{ $bss->question }}</p>
                            <br>
                            <div class="col-5 mx-4 px-4">
                                <label class="visually-hidden" for="inlineFormSelectPref">Answer</label>
                                <span class="strong text-lg font-14 font-weight-bold text-decoration-underline">Answer:
                                    {{ $bss->exercise_answer->exercise_option->content }}</span>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                    @php
                        $part += 1;
                    @endphp
                @endif
            @else
                <div class="alert alert-outline-danger" role="alert">
                    <strong>Questions are not added for this Exercise please contact Adminstrator</strong>
                </div>
            @endif
        </div>
    </div>
@endsection
