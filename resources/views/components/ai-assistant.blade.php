<!-- AI Assistant Widget -->
<div x-data="aiAssistant()" class="fixed bottom-6 right-6 z-50">
    <!-- Chat Button -->
    <button 
        @click="toggleChat()"
        class="w-16 h-16 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center group"
        :class="{ 'scale-0': isOpen }">
        <svg class="w-8 h-8 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
        </svg>
        <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 rounded-full animate-ping"></span>
        <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 rounded-full"></span>
    </button>

    <!-- Chat Window -->
    <div 
        x-show="isOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-95"
        x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-95"
        class="fixed bottom-6 right-6 w-96 h-[600px] bg-white dark:bg-gray-800 rounded-2xl shadow-2xl flex flex-col overflow-hidden border border-gray-200 dark:border-gray-700"
        style="display: none;">

        <!-- Header -->
        <div class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white p-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold" x-text="translations[currentLang].title"></h3>
                    <p class="text-xs text-white/80" x-text="translations[currentLang].subtitle"></p>
                </div>
            </div>
            <button @click="toggleChat()" class="text-white hover:bg-white/20 rounded-full p-2 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Messages -->
        <div class="flex-1 overflow-y-auto p-4 space-y-4" id="messages-container">
            <!-- Welcome Message -->
            <div class="flex gap-3">
                <div class="w-8 h-8 bg-gradient-to-r from-emerald-600 to-teal-600 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <div class="bg-gray-100 dark:bg-gray-700 rounded-2xl rounded-tl-none p-3">
                        <p class="text-sm text-gray-800 dark:text-gray-200" x-text="translations[currentLang].welcome"></p>
                    </div>
                </div>
            </div>

            <!-- Messages -->
            <template x-for="message in messages" :key="message.id">
                <div>
                    <div class="flex gap-3" :class="message.role === 'user' ? 'flex-row-reverse' : ''">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0"
                             :class="message.role === 'user' ? 'bg-emerald-600' : 'bg-gradient-to-r from-emerald-600 to-teal-600'">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path x-show="message.role === 'user'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                <path x-show="message.role === 'assistant'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                        <div class="flex-1 max-w-[80%]">
                            <div class="rounded-2xl p-3"
                                 :class="message.role === 'user' ? 'bg-emerald-600 text-white rounded-tr-none' : 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-tl-none'">
                                <p class="text-sm whitespace-pre-wrap" x-html="formatMessage(message.content)"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Product Cards -->
                    <template x-if="message.role === 'assistant' && message.products && message.products.length > 0">
                        <div class="mt-3 ml-11 space-y-2">
                            <template x-for="product in message.products" :key="product.id">
                                <div class="bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl p-3 flex gap-3 items-center shadow-sm">
                                    <template x-if="product.image">
                                        <img :src="product.image" :alt="product.name" class="w-14 h-14 object-cover rounded-lg flex-shrink-0 bg-gray-100">
                                    </template>
                                    <template x-if="!product.image">
                                        <div class="w-14 h-14 bg-gray-100 dark:bg-gray-600 rounded-lg flex-shrink-0 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                            </svg>
                                        </div>
                                    </template>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200 truncate" x-text="product.name"></p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate" x-text="product.reason"></p>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="text-sm font-bold text-emerald-600" x-text="'€' + parseFloat(product.price).toFixed(2)"></span>
                                            <template x-if="product.original_price">
                                                <span class="text-xs text-gray-400 line-through" x-text="'€' + parseFloat(product.original_price).toFixed(2)"></span>
                                            </template>
                                        </div>
                                    </div>
                                    <button
                                        @click="addToCart(product)"
                                        :disabled="!product.in_stock || product.adding"
                                        class="flex-shrink-0 w-9 h-9 rounded-full flex items-center justify-center transition-all duration-200"
                                        :class="product.added ? 'bg-green-500 text-white' : (product.in_stock ? 'bg-emerald-600 hover:bg-emerald-700 text-white' : 'bg-gray-200 text-gray-400 cursor-not-allowed')">
                                        <template x-if="product.added">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </template>
                                        <template x-if="product.adding && !product.added">
                                            <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                            </svg>
                                        </template>
                                        <template x-if="!product.adding && !product.added">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                            </svg>
                                        </template>
                                    </button>
                                </div>
                            </template>
                        </div>
                    </template>

                    <!-- Auto added to cart notification -->
                    <template x-if="message.role === 'assistant' && message.addedToCart && message.addedToCart.length > 0">
                        <div class="mt-2 ml-11">
                            <div class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 rounded-xl p-3">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <p class="text-xs text-green-700 dark:text-green-400 font-medium" x-text="translations[currentLang].added_notice + ' ' + message.addedToCart.join(', ')"></p>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </template>

            <!-- Loading indicator -->
            <div x-show="isLoading" class="flex gap-3">
                <div class="w-8 h-8 bg-gradient-to-r from-emerald-600 to-teal-600 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <div class="bg-gray-100 dark:bg-gray-700 rounded-2xl rounded-tl-none p-3">
                        <div class="flex gap-1">
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="px-4 py-2 border-t dark:border-gray-700">
            <div class="flex gap-2 overflow-x-auto pb-2">
                <template x-for="suggestion in translations[currentLang].suggestions" :key="suggestion">
                    <button
                        @click="sendMessage(suggestion)"
                        class="px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full text-xs whitespace-nowrap hover:bg-emerald-100 dark:hover:bg-emerald-900 hover:text-emerald-600 dark:hover:text-emerald-400 transition"
                        x-text="suggestion">
                    </button>
                </template>
            </div>
        </div>

        <!-- Input -->
        <div class="p-4 border-t dark:border-gray-700">
            <form @submit.prevent="sendMessage(userInput)" class="flex gap-2">
                <input
                    type="text"
                    x-model="userInput"
                    :placeholder="translations[currentLang].placeholder"
                    class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-full focus:outline-none focus:border-emerald-600"
                    :disabled="isLoading">
                <button
                    type="submit"
                    :disabled="isLoading || !userInput.trim()"
                    class="w-10 h-10 bg-emerald-600 text-white rounded-full flex items-center justify-center hover:bg-emerald-700 transition disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function aiAssistant() {
    return {
        isOpen: false,
        isLoading: false,
        userInput: '',
        messages: [],
        currentLang: '{{ app()->getLocale() }}',

        translations: {
            en: {
                title: 'AI Shopping Assistant',
                subtitle: 'Powered by Groq',
                welcome: '👋 Hi! I\'m your AI shopping assistant. I can help you find the perfect products, answer questions about PC building, and provide recommendations!',
                placeholder: 'Ask me anything...',
                suggestions: ['Build a gaming PC', 'Best laptops under €1000', 'GPU recommendations'],
                add_to_cart: 'Add to cart',
                out_of_stock: 'Out of stock',
                added_notice: '✅ Added to cart:'
            },
            lv: {
                title: 'AI Iepirkšanās Asistents',
                subtitle: 'Darbina Groq',
                welcome: '👋 Sveiki! Es esmu jūsu AI iepirkšanās asistents. Varu palīdzēt atrast ideālos produktus, atbildēt uz jautājumiem par datoru būvēšanu un sniegt ieteikumus!',
                placeholder: 'Jautājiet man jebko...',
                suggestions: ['Izveidot spēļu datoru', 'Labākie portatīvie datori zem €1000', 'GPU ieteikumi'],
                add_to_cart: 'Pievienot grozam',
                out_of_stock: 'Nav noliktavā',
                added_notice: '✅ Pievienots grozam:'
            },
            ru: {
                title: 'AI Помощник по покупкам',
                subtitle: 'На базе Groq',
                welcome: '👋 Привет! Я ваш AI помощник по покупкам. Могу помочь найти идеальные товары, ответить на вопросы о сборке ПК и дать рекомендации!',
                placeholder: 'Спросите меня о чём угодно...',
                suggestions: ['Собрать игровой ПК', 'Лучшие ноутбуки до €1000', 'Рекомендации по GPU'],
                add_to_cart: 'В корзину',
                out_of_stock: 'Нет в наличии',
                added_notice: '✅ Добавлено в корзину:'
            }
        },

        init() {
            document.addEventListener('languageChanged', (e) => {
                this.currentLang = e.detail.locale;
            });
        },

        toggleChat() {
            this.isOpen = !this.isOpen;
            if (this.isOpen) {
                this.$nextTick(() => this.scrollToBottom());
            }
        },

        async sendMessage(text) {
            if (!text || !text.trim()) return;

            const messageText = typeof text === 'string' ? text : this.userInput;

            this.messages.push({
                id: Date.now(),
                role: 'user',
                content: messageText,
                rawContent: messageText,
                products: [],
                addedToCart: []
            });

            this.userInput = '';
            this.isLoading = true;
            this.$nextTick(() => this.scrollToBottom());

            try {
                const apiMessages = this.messages.map(m => ({
                    role: m.role,
                    content: m.rawContent || m.content
                }));

                const response = await fetch('/ai-assistant/chat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({ messages: apiMessages })
                });

                const data = await response.json();

                if (data.success) {
                    this.messages.push({
                        id: Date.now() + 1,
                        role: 'assistant',
                        content: data.message,
                        rawContent: data.message,
                        products: (data.suggested_products || []).map(p => ({
                            ...p,
                            adding: false,
                            added: false
                        })),
                        addedToCart: data.added_to_cart || []
                    });

                    if (data.cart_count !== undefined) {
                        const cartBadge = document.getElementById("cart-count");
                        if (cartBadge) {
                            cartBadge.textContent = data.cart_count;
                            if (data.cart_count > 0) cartBadge.classList.remove("hidden");
                        }
                    }
                } else {
                    this.messages.push({
                        id: Date.now() + 1,
                        role: 'assistant',
                        content: data.message || this.getErrorMessage(),
                        rawContent: data.message || this.getErrorMessage(),
                        products: [],
                        addedToCart: []
                    });
                }
            } catch (error) {
                console.error('Error:', error);
                this.messages.push({
                    id: Date.now() + 1,
                    role: 'assistant',
                    content: this.getErrorMessage(),
                    rawContent: this.getErrorMessage(),
                    products: [],
                    addedToCart: []
                });
            } finally {
                this.isLoading = false;
                this.$nextTick(() => this.scrollToBottom());
            }
        },

        async addToCart(product) {
            if (!product.in_stock || product.adding || product.added) return;

            product.adding = true;

            try {
                const response = await fetch('/ai-assistant/add-to-cart', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({ product_id: product.id })
                });

                const data = await response.json();

                if (data.success) {
                    product.added = true;
                    const cartBadge = document.getElementById("cart-count");
                    if (cartBadge && data.cart_count !== undefined) {
                        cartBadge.textContent = data.cart_count;
                        cartBadge.classList.remove("hidden");
                    }
                    setTimeout(() => { product.added = false; }, 3000);
                }
            } catch (error) {
                console.error('Add to cart error:', error);
            } finally {
                product.adding = false;
            }
        },

        getErrorMessage() {
            const errors = {
                en: 'Sorry, I encountered an error. Please try again.',
                lv: 'Atvainojiet, radās kļūda. Lūdzu, mēģiniet vēlreiz.',
                ru: 'Извините, произошла ошибка. Пожалуйста, попробуйте еще раз.'
            };
            return errors[this.currentLang] || errors.en;
        },

        formatMessage(text) {
            if (!text) return "";
            return text
                .replace(/\*\*(.*?)\*\*/g, "<strong>$1</strong>")
                .replace(/^### (.*$)/gm, "<h3 class=\"font-bold text-sm mt-2\">$1</h3>")
                .replace(/^## (.*$)/gm, "<h3 class=\"font-bold text-sm mt-2\">$1</h3>")
                .replace(/^\* (.*$)/gm, "<li class=\"ml-3 list-disc\">$1</li>")
                .replace(/^- (.*$)/gm, "<li class=\"ml-3 list-disc\">$1</li>")
                .replace(/(<li.*<\/li>\n?)+/g, "<ul class=\"my-1\">$&</ul>")
                .replace(/\n/g, "<br>");
        },

        scrollToBottom() {
            const container = document.getElementById('messages-container');
            if (container) container.scrollTop = container.scrollHeight;
        }
    }
}
</script>
