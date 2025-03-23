@extends('BackEnd.Layout.base')
{{-- @section('title') --}}
@section('title', $assessment->title??"Exercise")


@section('content')
{{-- <h1>Well come</h1> --}}
<div class="card m-4 px-4 shadow-lg col-lg-10" style="background-color: #fFfFfE">
        <div class="p-4 m-4">

            @if ($tfQuestions || $mcQuestions || $bsQuestions)
                {{-- <form action="{{ route('submit_answer', ['exercise' => $exercise]) }}" method="post"> --}}
                @csrf
                @php
                    $part = 1;
                @endphp

                @if ($tfQuestions?->count() > 0)

                    <div class="alert alert-outline-primary border-0" role="alert">
                        <h4 class="text-decoration-underline">
                            <strong>Part {{ $part }}:</strong> Say True if the statement is correct or False if
                            the
                            statement is
                            wrong
                        </h4>
                    </div>
                    @foreach ($tfQuestions as $tf)
                        <div class="d-flex">
                            <span class="text-decoration-underline">{{ $tf->question_answer_Inst()->content }}</span>
                            <p class="mx-2">{{ $loop->index + 1 }}. {{ $tf->question }}
                            </p>
                        </div>
                        <hr>
                    @endforeach
                    <hr>
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
                                @php
                                    $alp = 'A';
                                    $ans_w = '';
                                @endphp
                                @foreach ($tff->question_keys as $opt)
                                    <div class="form-check my-1">
                                        <input class="form-check-input" type="radio"
                                            {{ $tff->question_answer_Inst()->id == $opt->key->id ? 'checked' : '' }}
                                            name="{{ $tff->id }}" id="{{ $opt->key->id }}"
                                            value="{{ $tff->id }}">
                                        <label class=" font-weight-bold" for="{{ $opt->key->id }}">
                                            <b>{{ $alp }}. {{ $opt->key->content }}</b>
                                        </label>
                                    </div>
                                    @php
                                        $tff->question_answer_Inst()->id == $opt->key->id ? ($ans_w = $alp) : '';
                                        $alp++;
                                    @endphp
                                @endforeach
                                <b>

                                    <span class="my-2 px-2 text-bg-success font-14"><u class="mx-2">
                                            Answer:</u>
                                        {{ $ans_w }}. {{ $tff->question_answer_Inst()->content }}</span>
                                </b>

                            </div>

                        </div>
                        <hr>
                    @endforeach
                    <hr>
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
                        <div class="d-flex  my-1">
                            <p class="col-9 mx-2">{{ $loop->index + 1 }}. {{ $bss->question }}</p>
                            <br>
                            <div class="col-3 mx-4 px-4">

                                Answer: {{ $bss->question_answer_Inst()->content }}
                            </div>
                        </div>
                        <hr>
                    @endforeach
                    @php
                        $part += 1;
                    @endphp
                @endif
                <div class="d-flex justify-content-end">
                    {{-- <button type="submit" class="btn btn-primary"></button> --}}

                </div>
                {{-- </form> --}}
            @else
                <div class="alert alert-outline-danger" role="alert">
                    <strong>Questions are not added for this Exercise please contact Adminstrator</strong>
                </div>
            @endif
        </div>
    </div>
@endsection
