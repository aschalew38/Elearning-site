@extends('Elearning.Classes.base')
@section('title', $assessment->title)
@section('content')

    <div class="card m-4 px-4 shadow-lg col-lg-10" style="background-color: #fFfFfE">
        <div class="shadow">
            <div class="row no-gutters">
                <div class="col-md-12">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col d-flex  justify-content-between px-4">
                                {{-- {{ $assessment }} --}}
                                <h4 class="card-title">Your Score: {{ $result->result }}</h4>
                                <h4 class="card-title">Total  Weight: {{ $assessment->Weight }}</h4>
                            </div><!--end col--><!--end col-->
                        </div> <!--end row-->
                    </div><!--end card-header-->
                    <div class="card-body">
                    </div><!--end card-body-->
                </div><!--end col-->
            </div><!--end row-->
        </div>
        <div class="p-4">
            {{-- <h5 class="underline">Total Score:{{ $result->result }}</h5> --}}
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
                        <b>
                            <p class="my-2 px-2 bg-primary text-white font-14 px-2 py-1 rounded mx-auto"><u class="mx-2">
                                Your Answer:</u>
                             {{ $tf->YourAnswer?->content }}</p>
                    </b>
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
                                           disabled
                                            {{ $tff->YourAnswer?->id == $opt->key->id ? 'checked' : '' }}
                                            name="{{ $tff->id }}" id="{{ $opt->key->id }}"
                                            value="{{ $tff->id }}">
                                        <label class=" font-weight-bold" for="{{ $opt->key->id }}">
                                            <b>{{ $alp }}. {{ $opt->key->content }}</b>
                                            {{-- {{ $opt->key->id }} --}}
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
                                <b>

                                    <p class="my-2 px-2 bg-primary text-white font-14 px-2 py-1 rounded mx-auto"><u class="mx-2">
                                            Your Answer:</u>
                                         {{ $tff->YourAnswer?->content }}</p>
                                </b>


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
                        <p class="my-2 px-2 bg-primary text-white font-14 px-2 py-1 rounded mx-auto"><u class="mx-2">
                            Your Answer:</u>
                         {{ $bss->YourAnswer?->content }}</p>
                </b>
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
    {{-- {{ $assessment->course()}} --}}
    <div class="d-flex flex-row-reverse">
        <a href="{{ route('gotoclass',['course'=>$course?->id]) }}">
        <button  class="btn btn-primary">Go Back</button></a>

    </div>
@endsection
