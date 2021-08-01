<template>
    <b-form>
        <b-form-group
            id="fieldset-title"
            :description="item.slug"
            :label="$t('ARTICLE.create.title.title')"
            label-for="title"
        >
            <b-form-input
                id="title"
                v-model="item.title"
                :placeholder="$t('ARTICLE.create.title.placeholder')"
                trim
            ></b-form-input>
        </b-form-group>
        <b-form-group
            id="fieldset-text"
            :label="$t('ARTICLE.create.textarea.title')"
            label-for="text"
        >
            <b-form-textarea
                id="text"
                v-model="item.text"
                :placeholder="$t('ARTICLE.create.textarea.placeholder')"
            >{{ item.text }}
            </b-form-textarea>
        </b-form-group>
        <div class="d-flex justify-content-end">
            <b-button type="submit" variant="primary" @click.prevent="saveArticle">{{ $t('BUTTONS.save') }}</b-button>
            <b-button type="reset" class="ml-1" @click.prevent="$router.push({name: 'indexArticle'})">{{ $t('BUTTONS.cancel') }}</b-button>
        </div>
    </b-form>
</template>

<script>
    import {BForm, BFormGroup, BFormInput, BFormTextarea} from "bootstrap-vue";
    import slug from "slug";

    export default {
        name: "UpdateArticle",
        components: {
            BForm,
            BFormGroup,
            BFormInput,
            BFormTextarea
        },
        props: {
          id: {
              type: [Number, String],
              required: true
          }
        },
        data() {
            return {
                item: {
                    title: '',
                    slug: '',
                    text: ''
                }
            }
        },
        watch: {
            'item.title'() {
                if(this.item.title)
                    this.item.slug = slug(this.item.title)
            }
        },
        mounted() {
            this.$store.dispatch('article/fetchArticle', this.id)
                .then(res => {
                    this.item = res.data.data
                })
        },
        methods: {
            saveArticle() {
                this.$store.dispatch('article/updateArticle', {
                    id: this.id,
                    data: this.item
                })
                    .then(res => {
                        this.$swal({
                            title: this.$t('ARTICLE.messages.created')
                        }).then(() => {
                            this.$router.push({ name: 'indexArticle' })
                        })
                    })
            }
        }
    }
</script>
