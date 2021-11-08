@extends('layouts.user')
@section('content')
<section class="section is-main-section"  id="testing">
   <div class="columns">
      <div class="column is-4">
         <div class="card tile is-child">
            <div class="card-content">
               <div class="columns">
                  <div class="col ml-2">
                     <span class="material-icons is-size-1">assignment</span>
                  </div>
                  <div class="col ml-6">
                     <h2 class="is-size-4" >@{{quiz.total}}</h2>
                     <h4 class="is-size-5" >{{ trans('fe.total_questions') }}</h4>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="column is-4">
         <div class="card tile is-child">
            <div class="card-content">
               <div class="columns">
                  <div class="col ml-2">
                     <span class="material-icons is-size-1">credit_score</span>
                  </div>
                  <div class="col ml-6">
                     <h2 class="is-size-4">@{{quiz.percentage}}%</h2>
                     <h4 class="is-size-5">{{ trans('fe.required_score') }}</h4>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="column is-4">
         <div class="card tile is-child">
            <div class="card-content">
               <div class="columns">
                  <div class="col ml-2">
                     <span class="material-icons is-size-1">timer</span>
                  </div>
                  <div class="col ml-6">
                     <h2 class="is-size-4">@{{timeLeft}}</h2>
                     <h4 class="is-size-5">{{ trans('fe.time_to_complete') }}</h4>
                     <h2> @{{timeLeft}}</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="columns" >
      <div class="column is-4">
         <div class="card tile is-child">
            <div class="card-content">
               <div class="is-mobile" v-if="showQuestions == true">
                  <h2 class="is-underlined has-text-weight-bold">{{ trans('fe.questions') }}</h2>
                  
                  @foreach($course->questions as $index => $question)
                  
                  @endforeach

                  <div class="block" v-for="(qstn, index) in quiz.questions" :key="index" v-bind:class="qstn.id == activeItem ? 'has-text-link' : ''" >
                     <p class="columns"   v-on:click="getQuestion(qstn.id); startQuiz();">
                        <span class="column is-1" >@{{index+1}}.</span> 
                        &nbsp; 
                        <span class="column is-11">
                           @{{qstn.name}}
                        </span>
                     </p>
                  </div>

               </div>

               <div class="is-mobile" v-if="showQuestions == false">
                  <p class="is-size-5">
                     {!! trans('fe.click_to_start') !!}
                  </p>
               </div>
            </div>
         </div>
      </div>
      <div class="column is-8">
         <div class="card tile is-child" v-if="question != null">
            <div class="card-content" v-if="showQuestions == true">
               <div class="is-mobile">
                  <h2 class="is-underlined has-text-weight-bold">{{ trans('fe.current_question') }}</h2>
                  <br/>
                  <span v-if="question != null">
                     @{{question.name}}
                  </span>
               </div>
            </div>
         </div>

         
         <div class="card  i--s-child">
            <div class="card-content" v-if="showQuestions == true">
               <div class="is-mobile">
                  <h2 class="is-underlined has-text-weight-bold">{{ trans('fe.choose_answer') }}</h2>
                  
                  <br/>
                  <div class="columns is-multiline" v-if="answers != null">
                     <div class="column is-12" v-for="(answer, index) in answers" >
                        <p class="mt-1 mb-1" >
                           <div class="control">
                              <label class="radio">
                              <input type="radio" v-model="answerId" :value="answer.id" >
                              @{{answer.name}}
                              </label>
                           </div>
                        </p>
                     </div>
                  </div>

                  <div class="columns is-multiline" v-if="answers != null">
                     <div class="column is-12">
                        <button class="button is-large is-primary" v-on:click="sendAnswer(); checkEnd();" :disabled="answerId == null" >{{ trans('fe.submit_answer') }}</button>
                     </div>
                     <div class="column is-6" >
                        <span v-if="quiz.questions.findIndex((item) => item.id === question.id) > 0">
                           <button  class="button  is-danger is-pulled-left" v-on:click="getQuestion(quiz.questions[quiz.questions.findIndex((item) => item.id === question.id) - 1].id)" ><span class="material-icons">arrow_back</span></button>
                        </span>
                        
                     </div>
                     <div class="column is-6">
                        <span v-if="quiz.questions.findIndex((item) => item.id === question.id) < quiz.questions.length-1">
                           <button class="button  is-link is-pulled-right" v-on:click="getQuestion(quiz.questions[quiz.questions.findIndex((item) => item.id === question.id) + 1].id)" ><span class="material-icons">arrow_forward</span></button>
                        </span>
                     </div>
                  </div>
               </div>
            </div>

            <div class="card-content" v-if="showQuestions == false">
               <div class="is-mobile">
                  
                  
                  <button class=" button is-large is-primary" v-on:click=" getQuestion(quiz.questions[0].id); startQuiz();">{{ trans('fe.start') }} </button>
               </div>
            </div>

         </div>
      </div>
   </div>


   <hr style="border-bottom: solid red 5px;">



</section>


<script type="text/javascript">
   Vue.config.devtools = true;
   var app = new Vue({
     el: '#testing',
     data: {
       message: 'Hello Vue!',
       question: null,
       answers: null,
       quiz: null,

       answerId: null,
       questionId: null,
       courseId: {{$course->id}},
       activeItem: null,
       currentIndex: null,
       started: false, 
       userId: {{auth()->user()->id}},
       companyId: {{auth()->user()->company->id}},
       theEnd: false,
       time: {{$course->duration * 60}}, //in seconds
       timer: null,
       showQuestions: false,
       
     },
     methods: {
      startQuiz() {
         if(this.started == false) {
            this.started = true;
            this.timer = setInterval(this.decrementOrAlert, 1000);
         }

         this.showQuestions = true;
         
      },

      decrementOrAlert () {
           if (this.time > 0) {
             this.time--
             return
         }
         this.endQuiz();
         alert("Time is up!")
         clearInterval(this.timer)
       },
      
      endQuiz() {
        axios.post('{{url("api/end")}}', {
          course: this.courseId,
          user: this.userId,
          end: this.theEnd,
          
        }).then((response) => {

            
            if(response.data.url != null) {
               window.location.href = response.data.url ;
            }
        })
        .catch((e) => {
          console.error(e)
        })
      },

      getQuestion(id) {
        axios.get('{{url("api/question")}}/'+id, {
        }).then((response) => {
          this.question = response.data.question;
          this.answers = response.data.answers;
          this.questionId = response.data.question.id;
          this.activeItem = response.data.question.id
        }) 
        .catch((e) => {
          console.error(e)
        })
      },
      getQuiz(id) {
         axios.get('{{url("api/course")}}/'+id, {
           }).then((response) => {
             this.quiz = response.data;
           })
           .catch((e) => {
             console.error(e)
           })
      },

      checkEnd() {
         if(this.quiz.questions[this.quiz.questions.length-2].id == this.questionId) {
            this.theEnd = true;
         }
      },

      sendAnswer() {
        axios.post('{{url("api/send")}}', {
          question: this.questionId,
          course: this.courseId,
          answer: this.answerId,
          user: this.userId,
          company: this.companyId,
          end: this.theEnd,
          
        }).then((response) => {

            
            if(response.data.url != null) {
               // go to this link 
               this.dddata = response.data.url;
               window.location.href = response.data.url ;
            }
            if(response.data.status == "OK") {
               this.message = "Umbrella ";
               // this.dddata = response.data.answer;
               this.getQuestion(this.quiz.questions[this.quiz.questions.findIndex((item) => item.id === this.questionId) + 1].id);
               this.answerId = null;
            }
        })
        .catch((e) => {
          console.error(e)
        })
      }
     },
     created() {
      this.getQuiz({{$course->id}});
      this.getQuestion(quiz.questions[0].id); 
      this.startQuiz()
      },

      beforeMount(){
       // this.getUnits()
       // this.startQuiz();
    },

      computed: {
       timeLeft () {
           return `${this.minutes} m ${this.seconds} s`
       },
       minutes () {
           return String(Math.floor(this.time / 60)).padStart(2, '0')
       },
       seconds () {
           return String(this.time % 60).padStart(2, '0')
       }
     }
   })
</script>
@endsection