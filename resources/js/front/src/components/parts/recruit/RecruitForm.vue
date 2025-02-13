<script setup lang="ts">
import axios from 'axios';
import { isReactive, onMounted, Ref, ref, computed } from 'vue';

const name: Ref<string> = ref('');
const mail: Ref<string> = ref('');
const age: Ref<number> = ref('');
const gender: Ref<string> = ref('');
const attendance: Ref<string> = ref('');
const experience: Ref<string> = ref('');
const question: Ref<string> = ref('');


const ageList = computed(() => {
  let ages = [];
  for(let i = 15; i <= 65; i++) {
    ages.push(i);
  }
  return ages;
});


const isShowForm = ref<Boolean>(true);
const isShowConfirm = ref<Boolean>(false);

const errors: Ref<{
  name: [string];
  mail: [string];
  age: [string];
  gender: [string];
  attendance: [string];
  experience: [string];
  question: [string];
}> = ref({});

const submit = () => {
  axios
    .post('api/recruit', {
      name: name.value,
      mail: mail.value,
      age: age.value,
      gender: gender.value,
      attendance: attendance.value,
      experience: experience.value,
      question: question.value,
    })
    .then((result) => {
      console.log(result);
      // isShowForm.value = false;
      isShowConfirm.value = false;
    })
    .catch((err) => {
      console.log(err.response);
      errors.value = err.response.data.errors;
    });
};

const showConfirm = () => {
  errors.value.name = [''];
  errors.value.mail = [''];
  errors.value.age = [''];
  errors.value.gender = [''];
  errors.value.attendance = [''];
  errors.value.experience = [''];
  
  if (!name.value) {
    errors.value.name = ['お名前は必須です']
  }
  
  if (!mail.value) {
    errors.value.mail = ['メールアドレスは必須です']
  }
  
  if (!age.value) {
    errors.value.age = ['年齢は必須です']
  }
  
  if (!gender.value) {
    errors.value.gender = ['性別は必須です']
  }
  
  if (!attendance.value) {
    errors.value.attendance = ['参加頻度は必須です']
  }
  
  if (!experience.value) {
    errors.value.experience = ['経験は必須です']
  }
  
  if (errors.value.name[0]
    || errors.value.mail[0]
    || errors.value.age[0]
    || errors.value.gender[0]
    || errors.value.attendance[0]
    || errors.value.experience[0]) {
    return
  }
  
  isShowConfirm.value = true;
  isShowForm.value = false;
  // emits('setCaption', '入力内容の確認')
}

const fixContents = () => {
  isShowConfirm.value = false;
  isShowForm.value = true;
}


</script>

<template>
  
  <div>
    <div v-if="isShowForm">
      <table class="ta1">
        <caption>FCクオーレでは一緒にプレーしてくれるメンバーを募集しています。</caption>
        <div>
          応募条件は、20歳以上でゆめりあフットサル場に自力で来れる方。
        </div>
      </table>
      <div class="Form">
        <div class="Form-Item">
          <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>お名前</p>
          <input name="name" v-model="name" type="text" class="Form-Item-Input" placeholder="例）山田太郎" />
          <span v-for="error in errors.name" v-show="error" class="error-msg">{{ error }}</span>
        </div>
        <div class="Form-Item">
          <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>メールアドレス</p>
          <input name="mail" v-model="mail" type="email" class="Form-Item-Input" placeholder="例）example@gmail.com" />
          <span v-for="error in errors.mail" v-show="error" class="error-msg">{{ error }}</span>
        </div>
        <div class="Form-Item">
          <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>年齢</p>
          <select name="age" v-model="age" class="Form-Item-Input w-25">
            <option></option>
            <option v-for="n in ageList" :value="n">{{ n }}</option>
          </select>
          <div class="sai">
            <span>歳</span>
          </div>
        </div>
        <div class="errors">
          <span v-for="error in errors.age" v-show="error" class="error-msg">{{ error }}</span>
        </div>
        <div class="Form-Item">
          <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>性別</p>
          <select name="gender" v-model="gender" class="Form-Item-Input w-25">
            <option value=""></option>
            <option value="男性">男性</option>
            <option value="女性">女性</option>
          </select>
        </div>
        <div class="errors">
          <span v-for="error in errors.gender" v-show="error" class="error-msg">{{ error }}</span>
        </div>
        <div class="Form-Item">
          <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>参加頻度(予定)</p>
          <select name="attendance" v-model="attendance" class="Form-Item-Input w-50">
            <option value=""></option>
            <option value="月に1回ぐらい">月に1回ぐらい</option>
            <option value="月に2回ぐらい">月に2回ぐらい</option>
            <option value="ほぼ毎週参加">ほぼ毎週参加</option>
            <option value="不定期">不定期</option>
          </select>
        </div>
        <div class="errors">
          <span v-for="error in errors.attendance" v-show="error" class="error-msg">{{ error }}</span>
        </div>
        <div class="Form-Item">
          <p class="Form-Item-Label isMsg"><span class="Form-Item-Label-Required">必須</span>フットサル、サッカー経験</p>
          <textarea name="content" v-model="experience" class="Form-Item-Textarea" placeholder="例）パスやトラップなど基本的な事は一通りできるなど。"></textarea>
          <span v-for="error in errors.experience" v-show="error" class="error-msg">{{ error }}</span>
        </div>
        <div class="Form-Item">
          <p class="Form-Item-Label isMsg">質問</p>
          <textarea name="question" v-model="question" class="Form-Item-Textarea"></textarea>
          <span v-for="error in errors.question" v-show="error" class="error-msg">{{ error }}</span>
        </div>
<!--        <input type="submit" @click="showConfirm" class="Form-Btn" value="確認画面へ" />-->
        <button @click="showConfirm" class="Form-Btn">確認画面へ</button>
      </div>
    </div>
    <div v-else class="thanks">
      <div v-if="isShowConfirm" class="Form">
        <table class="ta1">
          <caption>入力内容の確認</caption>
        </table>
        <div class="Form-Item">
          <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>お名前</p>
          <div>{{ name }}</div>
        </div>
        <div class="Form-Item">
          <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>メールアドレス</p>
          <div>{{ mail }}</div>
        </div>
        <div class="Form-Item">
          <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>年齢</p>
          <div>{{ age }}<span>歳</span></div>
        </div>
        <div class="Form-Item">
          <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>性別</p>
          <div>{{ gender }}</div>
        </div>
        <div class="Form-Item">
          <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>参加頻度(予定)</p>
          <div>{{ attendance }}</div>
        </div>
        <div class="Form-Item">
          <p class="Form-Item-Label isMsg"><span class="Form-Item-Label-Required">必須</span>フットサル、サッカー経験</p>
          <div class="u-pre-wrap" v-text="experience"></div>
        </div>
        <div class="Form-Item">
          <p class="Form-Item-Label isMsg">質問</p>
          <div class="u-pre-wrap" v-text="question"></div>
        </div>
        <input type="submit" @click="fixContents" class="Form-Btn" value="入力内容を変更する" />
        <input type="submit" @click="submit" class="Form-Btn" value="送信する" />
      </div>
      <div v-else class="center">
        <table class="ta1">
          <caption>応募完了</caption>
        </table>
        <h4>お問合せありがとうございました。</h4>
        <router-link :to="{ name: 'home' }"><span>トップへ戻る</span></router-link>
      </div>
    </div>
  </div>
</template>

<style scoped>
.sai {
  font-size: 17px;
  margin-left: 10px;
  margin-top: 25px;
}
.center {
  text-align: center;
}

.w-25 {
  width: 25%;
}
.w-50 {
  width: 50%;
}

.errors {
  padding-left: 14px;
  padding-right: 14px;
  padding-top: 0px;
  padding-bottom: 16px;
}

.u-pre-wrap {
  white-space: pre-wrap;
}
</style>
