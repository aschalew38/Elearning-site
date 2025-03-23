@extends('Elearning.Classes.base')
{{-- @section('title') --}}
@section('title', $assessment->title??"Exercise")
@section('content')
    <div class="card m-4 px-4 shadow-lg col-lg-8 mx-auto" style="background-color: #fFfFfE">
        <div class="p-4 m-4">
            {{-- @dd($assessment); --}}
            @if ($tfQuestions || $mcQuestions || $bsQuestions)
                <form action="{{ route('submit_answer', ['assessment' => $assessment]) }}" method="post">
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
                            <div class="d-flex align-items-center my-1">
                                <div class="col-2">
                                    <label class="visually-hidden" for="inlineFormSelectPref">True or False</label>
                                    <select class="form-select" id="{{ $tf->id }}" name="{{ $tf->id }}">
                                        {{-- <option selected="">Choose...</option> --}}
                                        <option value="True">True</option>
                                        <option value="False">False</option>
                                    </select>
                                </div>
                                <p class="col-10  mt-3 mx-2">{{ $loop->index + 1 }}. {{ $tf->question }}</p>

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
                                    @foreach ($tff->question_keys as $opt)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="{{ $tff->id }}"
                                                id="{{ $opt->key->id }}" value="{{ $opt->key->id }}">
                                            <label class=" font-weight-bold" for="{{ $opt->key->id }}">
                                                <b>{{ $opt->key->content }}</b>
                                            </label>
                                        </div>
                                    @endforeach

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
                                    <label class="visually-hidden" for="inlineFormSelectPref">Answer</label>
                                    <input type="text" class="col-12" name="{{ $bss->id }}" />
                                </div>
                            </div>
                            <hr>
                        @endforeach
                        @php
                            $part += 1;
                        @endphp
                    @endif
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Submit Answer</button>

                    </div>
                </form>
            @else
                <div class="alert alert-outline-danger" role="alert">
                    <strong>Questions are not added for this Exercise please contact Adminstrator</strong>
                </div>
            @endif
        </div>
    </div>
@endsection
