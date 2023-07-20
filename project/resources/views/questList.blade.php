@extends('layout.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/quest.css') }}">  
@endsection

@section('title', '퀘스트 수락')

@section('contents')
<h1>퀘스트 수락</h1>
<ul class="cards">
    <li>
        <a href="" class="card">
            <img src="https://i.imgur.com/oYiTqum.jpg" class="card__image" alt="" />
            <div class="card__overlay">
            <div class="card__header">
                <svg class="card__arc" xmlns="http://www.w3.org/2000/svg"><path /></svg>                     
                <img class="card__thumb" src="https://i.imgur.com/7D7I6dI.png" alt="" />
                <div class="card__header-text">
                <h3 class="card__title">Jessica Parker</h3>            
                <span class="card__status">1 hour ago</span>
                </div>
            </div>
            <p class="card__description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores, blanditiis?</p>
            </div>
        </a>      
    </li>
    <li>
        <a href="" class="card">
            <img src="https://i.imgur.com/2DhmtJ4.jpg" class="card__image" alt="" />
            <div class="card__overlay">        
            <div class="card__header">
                <svg class="card__arc" xmlns="http://www.w3.org/2000/svg"><path /></svg>                 
                <img class="card__thumb" src="https://i.imgur.com/sjLMNDM.png" alt="" />
                <div class="card__header-text">
                <h3 class="card__title">kim Cattrall</h3>
                <span class="card__status">3 hours ago</span>
                </div>
            </div>
            <p class="card__description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores, blanditiis?</p>
            </div>
        </a>
    </li>
    <li>
        <a href="" class="card">
            <img src="https://i.imgur.com/oYiTqum.jpg" class="card__image" alt="" />
            <div class="card__overlay">
            <div class="card__header">
                <svg class="card__arc" xmlns="http://www.w3.org/2000/svg"><path /></svg>                     
                <img class="card__thumb" src="https://i.imgur.com/7D7I6dI.png" alt="" />
                <div class="card__header-text">
                <h3 class="card__title">Jessica Parker</h3>
                <span class="card__tagline">Lorem ipsum dolor sit amet consectetur</span>            
                <span class="card__status">1 hour ago</span>
                </div>
            </div>
            <p class="card__description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores, blanditiis?</p>
            </div>
        </a>
    </li>
    <li>
        <a href="" class="card">
            <img src="https://i.imgur.com/2DhmtJ4.jpg" class="card__image" alt="" />
            <div class="card__overlay">
            <div class="card__header">
                <svg class="card__arc" xmlns="http://www.w3.org/2000/svg"><path /></svg>                 
                <img class="card__thumb" src="https://i.imgur.com/sjLMNDM.png" alt="" />
                <div class="card__header-text">
                <h3 class="card__title">kim Cattrall</h3>
                <span class="card__status">3 hours ago</span>
                </div>          
            </div>
            <p class="card__description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores, blanditiis?</p>
            </div>
        </a>
    </li>    
    <li>
        <a href="" class="card">
            <img src="https://i.imgur.com/2DhmtJ4.jpg" class="card__image" alt="" />
            <div class="card__overlay">
            <div class="card__header">
                <svg class="card__arc" xmlns="http://www.w3.org/2000/svg"><path /></svg>                 
                <img class="card__thumb" src="https://i.imgur.com/sjLMNDM.png" alt="" />
                <div class="card__header-text">
                <h3 class="card__title">kim Cattrall</h3>
                <span class="card__status">3 hours ago</span>
                </div>          
            </div>
            <p class="card__description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores, blanditiis?</p>
            </div>
        </a>
    </li>    
    <li>
        <a class="card">
            <img src="https://i.imgur.com/2DhmtJ4.jpg" class="card__image" alt="" />
            <div class="card__overlay">
            <div class="card__header">
                <svg class="card__arc" xmlns="http://www.w3.org/2000/svg"><path /></svg>                 
                <img class="card__thumb" src="https://i.imgur.com/sjLMNDM.png" alt="" />
                <div class="card__header-text">
                <h3 class="card__title">kim Cattrall</h3>
                <span class="card__status">3 hours ago</span>
                </div>          
            </div>
            <p class="card__description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores, blanditiis?</p>
            </div>
        </a>
    </li>    
</ul>


{{-- <div class="cards">
    <h1>퀘스트 수락</h1>
    
    <div class="options">
        @foreach ($data as $item)
            <div class="option" style="--optionBackground:url({{asset('img/quest_'.$item->quest_cate_id.'.jpg')}});">
                <div class="shadow"></div>
                <div class="label">
                    <div class="icon">
                        @if ($item->quest_cate_id === 1)
                            <i class="fas fa-tint"></i>
                        @elseif ($item->quest_cate_id === 2)
                            <i class="fa-solid fa-hand"></i>
                        @elseif ($item->quest_cate_id === 3)
                            <i class="fa-solid fa-person-walking"></i>
                        @elseif ($item->quest_cate_id === 4)
                            <i class="fa-solid fa-stairs"></i>
                        @else
                            <i class="fa-solid fa-bed"></i>
                        @endif
                    </div>
                    <div class="info">
                        <div class="main">{{$item->quest_name}}</div>
                        <div class="sub">{{$item->quest_content}} ｜ {{$item->min_period}}일</div>
                    </div>
                    <div class="button">
                        @if (isset($flg))
                        <form action="{{route('quest.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$item->quest_cate_id}}">
                            <button type="submit">시작하기</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <h6 id="questSet">
        @if (!isset($flg))
            이미 진행중인 퀘스트가 있습니다.
        @endif
    </h6>
</div> --}}
@endsection

@section('js')
    <script src="{{asset('js/quest.js')}}"></script>
@endsection