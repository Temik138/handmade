<template>
    <section class="main-section">
      <div class="product-container">
        <!-- Галерея изображений -->
        <div class="image-section" v-if="product && product.images">
          <div class="thumbnail-gallery">
            <img
              v-for="(image, index) in product.images"
              :key="index"
              :src="getImageUrl(image)"
              alt="Product thumbnail"
              class="thumbnail"
              :class="{ active: currentImageIndex === index }"
              @click="changeImage(index)"
            />
          </div>
          <img
            :src="currentImage"
            alt="Product main image"
            class="main-image"
            v-if="currentImage"
          />
        </div>
  
        <!-- Информация о товаре -->
        <div class="product-details" v-if="product">
          <h2 class="product-title">{{ product.name || 'Название товара' }}</h2>
          <p class="product-description">
            {{ product.description || 'Описание товара' }}
          </p>
          <div class="purchase-section">
            <span class="price">{{ product.price || 0 }} рублей</span>
            <div class="quantity-controls">
              <button class="quantity-btn" @click="decreaseQuantity">-</button>
              <span class="quantity">{{ quantity }}</span>
              <button class="quantity-btn" @click="increaseQuantity">+</button>
            </div>
            <button class="buy-button" @click="addToCart">Купить</button>
          </div>
        </div>
      </div>
    </section>
  </template>
  
  <script>
  export default {
    name: 'Product1',
    props: {
      productData: {
        type: Object,
        default: () => ({
          name: '',
          description: '',
          price: 0,
          images: [],
          image: ''
        })
      }
    },
    data() {
      return {
        product: null,
        currentImageIndex: 0,
        quantity: 1
      }
    },
    created() {
      // Инициализация с защитой от undefined
      this.product = {
        ...{
          name: '',
          description: '',
          price: 0,
          images: [],
          image: ''
        },
        ...this.productData
      };
      
      // Преобразуем images, если это строка
      if (typeof this.product.images === 'string') {
        try {
          this.product.images = JSON.parse(this.product.images);
        } catch (e) {
          this.product.images = [];
        }
      }
      
      // Если images пуст, но есть основное изображение
      if (this.product.images.length === 0 && this.product.image) {
        this.product.images = [this.product.image];
      }
    },
    computed: {
      currentImage() {
        if (!this.product || !this.product.images) return '';
        return this.getImageUrl(this.product.images[this.currentImageIndex]);
      }
    },
    methods: {
      getImageUrl(imagePath) {
        if (!imagePath) return '';
        // Если путь уже полный (http://...)
        if (imagePath.startsWith('http')) return imagePath;
        // Для локальных изображений
        return `/storage/${imagePath}`;
      },
      changeImage(index) {
        if (this.product?.images?.length > index) {
          this.currentImageIndex = index;
        }
      },
      increaseQuantity() {
        this.quantity++;
      },
      decreaseQuantity() {
        if (this.quantity > 1) {
          this.quantity--;
        }
      },
      addToCart() {
        alert(`Добавлено в корзину: ${this.product.name} (${this.quantity} шт.)`);
      }
    }
  }
  </script>
  <style scoped>
  /* Ваши существующие стили без изменений */
  .main-section {
    color: white;
    font-family: "Montserrat";
    width: 100%;
    min-height: 100vh;
    padding: 20px;
    box-sizing: border-box;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  .product-container {
    display: flex;
    max-width: 800px;
    gap: 40px;
    align-items: center;
  }
  
  .image-section {
    display: flex;
    gap: 20px;
  }
  
  .thumbnail-gallery {
    display: flex;
    flex-direction: column;
    gap: 15px;
  }
  
  .thumbnail {
    width: 80px;
    height: 120px;
    object-fit: cover;
    cursor: pointer;
    border: 2px solid transparent;
    transition: all 0.3s;
    border-radius: 5px;
  }
  
  .thumbnail:hover {
    transform: scale(1.05);
  }
  
  .thumbnail.active {
    border-color: #884535;
    transform: scale(1.1);
  }
  
  .main-image {
    width: 350px;
    height: 500px;
    object-fit: cover;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
  }
  
  .product-details {
    font-family: "Montserrat", sans-serif;
    color: white;
    max-width: 400px;
  }
  
  .product-title {
    font-size: 28px;
    font-weight: 600;
    margin-bottom: 20px;
  }
  
  .product-description {
    font-size: 16px;
    line-height: 1.6;
    margin-bottom: 30px;
  }
  
  .purchase-section {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }
  
  .price {
    font-size: 24px;
    font-weight: 600;
  }
  
  .quantity-controls {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
  }
  
  .quantity-btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #884535;
    border: 2px dashed white;
    color: white;
    font-size: 20px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
  }
  
  .quantity-btn:hover {
    background-color: #6d3626;
  }
  
  .quantity {
    font-size: 20px;
    min-width: 30px;
    text-align: center;
  }
  
  .buy-button {
    border-radius: 5px;
    background-color: #884535;
    border: 2px dashed white;
    padding: 15px 40px;
    font-size: 18px;
    color: white;
    cursor: pointer;
    transition: all 0.3s;
    width: 100%;
  }
  
  .buy-button:hover {
    background-color: #6d3626;
    transform: translateY(-2px);
  }
  
  @media (max-width: 768px) {
    .product-container {
      flex-direction: column;
      padding: 20px;
    }
    
    .image-section {
      flex-direction: column-reverse;
      align-items: center;
    }
    
    .thumbnail-gallery {
      flex-direction: row;
      margin-top: 20px;
    }
    
    .main-image {
      width: 100%;
      height: auto;
      max-height: 400px;
    }
    
    .product-details {
      max-width: 100%;
    }
  }
  </style>