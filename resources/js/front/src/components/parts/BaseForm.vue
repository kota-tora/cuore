<script setup lang="ts">
import axios from 'axios';
import { isReactive, onMounted, Ref, ref } from 'vue';
import { Category } from '../../types/src/store/Category'

const props = defineProps({
  showCategory: {
    type: Boolean,
    required: true,
  },
  caption: {
    type: String,
    required: false,
  },
  postUrl: {
    type: String,
    required: true,
  }
});

const emits = defineEmits<{(e: 'setCaption', value: string): void}>()

const name: Ref<string> = ref('');
const mail: Ref<string> = ref('');
const category: Ref<string> = ref('');
const content: Ref<string> = ref('');

const categories: Ref<Category[]> = ref([]);

const isShowForm = ref<Boolean>(true);
const isShowConfirm = ref<Boolean>(false);

const errName = ref('');
const errMail = ref('');
const errCategory = ref('');
const errContent = ref('');
const errors: Ref<{
  name: [string];
  mail: [string];
  category: [string];
  content: [string];
}> = ref({});

const submit = () => {
  console.log(name.value);
  console.log(mail.value);
  console.log(category.value);
  console.log(content.value);

  axios
    .post(props.postUrl, {
      name: name.value,
      mail: mail.value,
      category: category.value,
      content: content.value,
    })
    .then((result) => {
      console.log(result);
      emits('setCaption', 'お問い合わせ完了')
      isShowConfirm.value = false;
    })
    .catch((err) => {
      console.log(err.response);
      errors.value = err.response.data.errors;
      isShowConfirm.value = false
      isShowForm.value = true
    });
};

const showConfirm = () => {
  errors.value.name = [''];
  errors.value.mail = [''];
  errors.value.category = [''];
  errors.value.content = [''];
  
  if (!name.value) {
    errors.value.name = ['お名前は必須です']
  }
  
  if (!mail.value) {
    errors.value.mail = ['メールアドレスは必須です']
  }
  
  if (!category.value) {
    errors.value.category = ['カテゴリは必須です']
  }
  if (!content.value) {
    errors.value.content = ['お問い合わせ内容は必須です']
  }
  
  if (errors.value.name[0]  || errors.value.mail[0] || errors.value.category[0] || errors.value.content[0]) {
    return
  }
  
  isShowConfirm.value = true;
  isShowForm.value = false;
  emits('setCaption', '入力内容の確認')
}

const fixContents = () => {
  isShowConfirm.value = false;
  isShowForm.value = true;
}

onMounted(() => {
  axios.get('api/get_categories')
    .then((results) => {
      results.data.map((result: Category) => {
        categories.value.push(result);
      });
    })
    .catch((err) => {
      console.log(err);
    });
});

</script>

<template>
  
  <div>
    <table v-if="caption" class="ta1">
      <caption>{{ caption }}</caption>
    </table>
    <div v-if="isShowForm">
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
        <div v-if="showCategory" class="Form-Item">
          <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>カテゴリ</p>
          <select class="Form-Item-Input" name="category" v-model="category">
            <option>---</option>
            <option v-for="c_row in categories" :value="c_row.categoryId">{{ c_row.name }}</option>
          </select>
          <span v-for="error in errors.category" v-show="error" class="error-msg">{{ error }}</span>
        </div>
        <div class="Form-Item">
          <p class="Form-Item-Label isMsg"><span class="Form-Item-Label-Required">必須</span>お問い合わせ内容</p>
          <textarea name="content" v-model="content" class="Form-Item-Textarea"></textarea>
          <span v-for="error in errors.content" v-show="error" class="error-msg">{{ error }}</span>
        </div>
        <input type="submit" @click="showConfirm" class="Form-Btn" value="確認画面へ" />
      </div>
    </div>
    <div v-else class="thanks">
      <div v-if="isShowConfirm" class="Form">
        <div class="Form-Item">
          <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>お名前</p>
          <div>{{ name }}</div>
        </div>
        <div class="Form-Item">
          <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>メールアドレス</p>
          <div>{{ mail }}</div>
        </div>
        <div v-if="showCategory" class="Form-Item">
          <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>カテゴリ</p>
          {{ categories.filter((c) => c.categoryId == category )[0].name }}
        </div>
        <div class="Form-Item">
          <p class="Form-Item-Label isMsg"><span class="Form-Item-Label-Required">必須</span>お問い合わせ内容</p>
          <div class="u-pre-wrap" v-text="content"></div>
        </div>
        <input type="submit" @click="fixContents" class="Form-Btn" value="入力内容を変更する" />
        <input type="submit" @click="submit" class="Form-Btn" value="送信する" />
      </div>
      <div v-else class="center">
        <h4>お問合せありがとうございました。</h4>
        <router-link :to="{ name: 'home' }"><span>トップへ戻る</span></router-link>
      </div>
    </div>
  </div>
</template>

<style scoped>
  .center {
    text-align: center;
  }
  
  .u-pre-wrap {
    white-space: pre-wrap;
  }
</style>
