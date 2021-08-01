<template>
    <b-form>
        <b-form-group
            id="fieldset-title"
            :description="slug"
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
            >{{ item.text }}</b-form-textarea>
        </b-form-group>
        <div class="d-flex justify-content-end">
            <b-button type="submit" variant="primary" @click.prevent="createArticle">{{ $t('BUTTONS.create') }}</b-button>
            <b-button type="reset" class="ml-1" @click.prevent="$router.push({name: 'indexArticle'})">{{ $t('BUTTONS.cancel') }}</b-button>
        </div>
    </b-form>
</template>

<script>
    import { BForm, BFormGroup, BFormInput, BFormTextarea } from 'bootstrap-vue'
    import slug from 'slug'

    export default {
        name: "CreateArticle",
        components: {
            BForm,
            BFormGroup,
            BFormInput,
            BFormTextarea
        },
        data() {
            return {
                item: {
                    title: '',
                    text: ''
                }
            }
        },
        computed: {
            slug() {
                return slug(this.item.title)
            }
        },
        methods: {
            createArticle() {
                this.$store.dispatch('article/createArticle', {
                    title: this.item.title,
                    text: this.item.text,
                    slug: this.slug,
                }).then(res => {
                    this.$swal({
                        title: this.$t('ARTICLE.messages.created'),
                    }).then(() => {
                        this.$router.push({name: 'indexArticle'})
                    })
                })
            }
        }
    }
</script>

<style scoped>

</style>
