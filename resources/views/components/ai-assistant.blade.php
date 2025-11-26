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

            <!-- Messages will be inserted here -->
            <template x-for="message in messages" :key="message.id">
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
                            <p class="text-sm whitespace-pre-wrap" x-html="message.content"></p>
                        </div>
                    </div>
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
                suggestions: ['Build a gaming PC', 'Best laptops under €1000', 'GPU recommendations']
            },
            lv: {
                title: 'AI Iepirkšanās Asistents',
                subtitle: 'Darbina Groq',
                welcome: '👋 Sveiki! Es esmu jūsu AI iepirkšanās asistents. Varu palīdzēt atrast ideālos produktus, atbildēt uz jautājumiem par datoru būvēšanu un sniegt ieteikumus!',
                placeholder: 'Jautājiet man jebko...',
                suggestions: ['Izveidot spēļu datoru', 'Labākie portatīvie datori zem €1000', 'GPU ieteikumi']
            },
            ru: {
                title: 'AI Помощник по покупкам',
                subtitle: 'На базе Groq',
                welcome: '👋 Привет! Я ваш AI помощник по покупкам. Могу помочь найти идеальные товары, ответить на вопросы о сборке ПК и дать рекомендации!',
                placeholder: 'Спросите меня о чём угодно...',
                suggestions: ['Собрать игровой ПК', 'Лучшие ноутбуки до €1000', 'Рекомендации по GPU']
            }
        },

        init() {
            // Watch for language changes
            document.addEventListener('languageChanged', (e) => {
                this.currentLang = e.detail.locale;
            });
        },

        toggleChat() {
            this.isOpen = !this.isOpen;
            if (this.isOpen) {
                this.$nextTick(() => {
                    this.scrollToBottom();
                });
            }
        },

        async sendMessage(text) {
            if (!text || !text.trim()) return;

            const messageText = typeof text === 'string' ? text : this.userInput;
            
            this.messages.push({
                id: Date.now(),
                role: 'user',
                content: messageText
            });

            this.userInput = '';
            this.isLoading = true;
            this.$nextTick(() => this.scrollToBottom());

            try {
                console.log('Sending message to API:', messageText, 'Language:', this.currentLang);
                
                const response = await fetch('/api/ai-chat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        message: messageText,
                        language: this.currentLang
                    })
                });

                console.log('Response status:', response.status);
                
                if (!response.ok) {
                    const errorText = await response.text();
                    console.error('API Error:', errorText);
                    throw new Error(`API returned ${response.status}`);
                }

                const data = await response.json();
                console.log('API Response:', data);

                this.messages.push({
                    id: Date.now() + 1,
                    role: 'assistant',
                    content: data.response
                });
            } catch (error) {
                console.error('Error:', error);
                this.messages.push({
                    id: Date.now() + 1,
                    role: 'assistant',
                    content: this.getErrorMessage() + ' (Check console for details)'
                });
            } finally {
                this.isLoading = false;
                this.$nextTick(() => this.scrollToBottom());
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

        scrollToBottom() {
            const container = document.getElementById('messages-container');
            if (container) {
                container.scrollTop = container.scrollHeight;
            }
        }
    }
}
</script>
