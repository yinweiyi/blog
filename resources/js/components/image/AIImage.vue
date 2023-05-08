<template>
    <div class="app-container">
        <Waterfall
            :list="tableData"
            :row-key="options.rowKey"
            :gutter="options.gutter"
            :has-around-gutter="options.hasAroundGutter"
            :width="options.width"
            :breakpoints="options.breakpoints"
            :img-selector="options.imgSelector"
            :background-color="options.backgroundColor"
            :animation-effect="options.animationEffect"
            :animation-duration="options.animationDuration"
            :animation-delay="options.animationDelay"
            :lazyload="options.lazyload"
            :load-props="options.loadProps"
        >
            <template #item="{ item, url, index }">
                <div
                    class="bg-gray-900 rounded-lg shadow-md overflow-hidden transition-all duration-300 ease-linear hover:shadow-lg hover:shadow-gray-600 group">
                    <div class="overflow-hidden">
                        <LazyImg :url="item.image_url"
                                 class="cursor-pointer transition-all duration-300 ease-linear group-hover:scale-105"
                                 @click="selectedImageUrl = item.image_url"
                        />
                    </div>
                    <div class="px-4 pt-2 pb-4 border-t border-t-gray-800">
                        <div class="pt-3 flex  items-center border-t-gray-600 border-opacity-50">
                            <div class="text-gray-50 mr-10">
                                <button @click="onLikeImage(item, 'likes')">
                                    👍 {{ item.likes }}
                                </button>
                            </div>
                            <div class="text-gray-50">
                                <button @click="onLikeImage(item, 'hearts')">
                                    ❤️ {{ item.hearts }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </Waterfall>
        <div class="mask" v-if="selectedImageUrl != null && selectedImageUrl !== ''" @click="selectedImageUrl = ''">
            <img :src="selectedImageUrl" class="mask-image" />
        </div>
    </div>
</template>

<script setup>
import {reactive, ref, onMounted} from "vue";
import loadingPng from "../../../images/loading.png"
import errorPng from "../../../images/error.png"
import {LazyImg, Waterfall} from 'vue-waterfall-plugin-next'
import 'vue-waterfall-plugin-next/dist/style.css'

const props = defineProps({
    modelId: {
        type: Number,
        required: true
    },
    list: {
        type: Array,
        required: true
    },
    total: {
        type: Number,
        required: true
    }
})


const selectedImageUrl = ref('')

const tableData = ref(props.list)

const paginationData = reactive({
    currentPage: 1,
    pageSize: 15,
    total: parseInt(props.total)
})

const formData = reactive({
    model_id: props.modelId,
    page: paginationData.currentPage,
    pageSize: paginationData.pageSize
})

const loading = ref(false)
const getTableData = () => {
    loading.value = true
    formData.page = paginationData.currentPage
    formData.pageSize = paginationData.pageSize

    axios.get('/image/list', {params: formData}).then(res => {
        paginationData.total = res.data.data.total
        tableData.value.push(...res.data.data.list)
    }).finally(() => {
        loading.value = false
    })
}

const onScroll = () => {
    let scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
    let windowHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
    let scrollHeight = document.documentElement.scrollHeight || document.body.scrollHeight;
    if (scrollTop + windowHeight >= scrollHeight) {
        if (loading.value === false && Math.ceil(paginationData.total / paginationData.pageSize) > paginationData.currentPage) {
            paginationData.currentPage++
            getTableData()
        }
    }
}

const onLikeImage = (item, type) => {
    axios.post('/image/like', {image_id: item.id, type: type}).then(res => {
        if (res.data.code === 200) {
            item[type] = res.data.data
        }
    })
}

const options = reactive({
    // 唯一key值
    rowKey: 'id',
    // 卡片之间的间隙
    gutter: 10,
    // 是否有周围的gutter
    hasAroundGutter: true,
    // 卡片在PC上的宽度
    width: 320,
    // 自定义行显示个数，主要用于对移动端的适配
    breakpoints: {
        1320: {
            // 当屏幕宽度小于等于1200
            rowPerView: 5,
        },
        1200: {
            // 当屏幕宽度小于等于1200
            rowPerView: 4,
        },
        800: {
            // 当屏幕宽度小于等于800
            rowPerView: 3,
        },
        500: {
            // 当屏幕宽度小于等于500
            rowPerView: 2,
        },
    },
    // 动画效果
    animationEffect: 'animate__fadeInUp',
    // 动画时间
    animationDuration: 1000,
    // 动画延迟
    animationDelay: 300,
    // 背景色
    backgroundColor: '',
    // imgSelector
    imgSelector: 'src.original',
    // 加载配置
    loadProps: {
        loadingPng,
        errorPng,
    },
    // 是否懒加载
    lazyload: true,

})

onMounted(() => {
    window.addEventListener('scroll', onScroll)
})

</script>

<style scoped>
.mask{
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    z-index: 15000;
}
.mask .mask-image {
    position: absolute;
    top: 50%;
    left: 50%;
    max-width: 80%;
    max-height: 90%;
    transform: translate(-50%, -50%);
}
</style>
