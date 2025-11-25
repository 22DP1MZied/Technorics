<!-- AI Assistant Chat Widget -->
<div id="ai-assistant-root"></div>

<script type="module">
import React from 'https://esm.sh/react@18.2.0';
import { createRoot } from 'https://esm.sh/react-dom@18.2.0/client';

const { useState, useRef, useEffect } = React;

function AiAssistant() {
    const [isOpen, setIsOpen] = useState(false);
    const [messages, setMessages] = useState([
        {
            role: 'assistant',
            content: 'Hi! 👋 I\'m your Technorics shopping assistant. I can help you:\n\n• Find the perfect products\n• Build a custom PC within your budget\n• Answer questions about our store\n• Track your orders\n\nWhat can I help you with today?'
        }
    ]);
    const [input, setInput] = useState('');
    const [isLoading, setIsLoading] = useState(false);
    const messagesEndRef = useRef(null);

    const scrollToBottom = () => {
        messagesEndRef.current?.scrollIntoView({ behavior: 'smooth' });
    };

    useEffect(() => {
        scrollToBottom();
    }, [messages]);

    const sendMessage = async () => {
        if (!input.trim() || isLoading) return;

        const userMessage = { role: 'user', content: input.trim() };
        const newMessages = [...messages, userMessage];
        setMessages(newMessages);
        setInput('');
        setIsLoading(true);

        try {
            const response = await fetch('/api/ai-assistant/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
                body: JSON.stringify({
                    messages: newMessages.map(m => ({ role: m.role, content: m.content }))
                }),
            });

            const data = await response.json();

            if (data.success) {
                setMessages([...newMessages, {
                    role: 'assistant',
                    content: data.message
                }]);
            } else {
                setMessages([...newMessages, {
                    role: 'assistant',
                    content: 'Sorry, I encountered an error. Please try again.'
                }]);
            }
        } catch (error) {
            setMessages([...newMessages, {
                role: 'assistant',
                content: 'Sorry, I couldn\'t connect to the server. Please try again.'
            }]);
        } finally {
            setIsLoading(false);
        }
    };

    const handleKeyPress = (e) => {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    };

    const quickActions = [
        { label: '🖥️ Build a PC', prompt: 'I want to build a gaming PC. My budget is around €1500. What do you recommend?' },
        { label: '💻 Laptop recommendations', prompt: 'Can you recommend a good laptop for programming and general use?' },
        { label: '🎮 Gaming setup', prompt: 'I want to set up a gaming station. What products do I need?' },
        { label: '📦 Shipping info', prompt: 'What are your shipping options and delivery times?' },
    ];

    const handleQuickAction = (prompt) => {
        setInput(prompt);
    };

    return React.createElement('div', { className: 'fixed bottom-6 right-6 z-50' },
        // Chat Button
        !isOpen && React.createElement('button', {
            onClick: () => setIsOpen(true),
            className: 'w-16 h-16 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-full shadow-lg hover:shadow-xl transition-all transform hover:scale-110 flex items-center justify-center group'
        },
            React.createElement('svg', {
                className: 'w-8 h-8',
                fill: 'none',
                stroke: 'currentColor',
                viewBox: '0 0 24 24'
            },
                React.createElement('path', {
                    strokeLinecap: 'round',
                    strokeLinejoin: 'round',
                    strokeWidth: 2,
                    d: 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z'
                })
            ),
            React.createElement('span', {
                className: 'absolute -top-1 -right-1 w-4 h-4 bg-red-500 rounded-full animate-pulse'
            })
        ),

        // Chat Window
        isOpen && React.createElement('div', {
            className: 'w-96 h-[600px] bg-white rounded-2xl shadow-2xl flex flex-col overflow-hidden'
        },
            // Header
            React.createElement('div', {
                className: 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white p-4 flex items-center justify-between'
            },
                React.createElement('div', { className: 'flex items-center gap-3' },
                    React.createElement('div', {
                        className: 'w-10 h-10 bg-white/20 rounded-full flex items-center justify-center'
                    }, '🤖'),
                    React.createElement('div', null,
                        React.createElement('h3', { className: 'font-bold' }, 'Technorics Assistant'),
                        React.createElement('p', { className: 'text-xs text-emerald-100' }, 'Online • Ready to help')
                    )
                ),
                React.createElement('button', {
                    onClick: () => setIsOpen(false),
                    className: 'hover:bg-white/20 p-2 rounded-lg transition'
                },
                    React.createElement('svg', {
                        className: 'w-5 h-5',
                        fill: 'none',
                        stroke: 'currentColor',
                        viewBox: '0 0 24 24'
                    },
                        React.createElement('path', {
                            strokeLinecap: 'round',
                            strokeLinejoin: 'round',
                            strokeWidth: 2,
                            d: 'M6 18L18 6M6 6l12 12'
                        })
                    )
                )
            ),

            // Messages Area
            React.createElement('div', {
                className: 'flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50'
            },
                messages.map((msg, idx) =>
                    React.createElement('div', {
                        key: idx,
                        className: `flex ${msg.role === 'user' ? 'justify-end' : 'justify-start'}`
                    },
                        React.createElement('div', {
                            className: `max-w-[80%] p-3 rounded-2xl ${
                                msg.role === 'user'
                                    ? 'bg-emerald-600 text-white rounded-br-none'
                                    : 'bg-white text-gray-800 rounded-bl-none shadow-sm'
                            }`
                        },
                            React.createElement('p', {
                                className: 'text-sm whitespace-pre-wrap',
                                style: { wordBreak: 'break-word' }
                            }, msg.content)
                        )
                    )
                ),
                isLoading && React.createElement('div', {
                    className: 'flex justify-start'
                },
                    React.createElement('div', {
                        className: 'bg-white p-3 rounded-2xl rounded-bl-none shadow-sm'
                    },
                        React.createElement('div', { className: 'flex gap-1' },
                            React.createElement('div', { className: 'w-2 h-2 bg-gray-400 rounded-full animate-bounce', style: { animationDelay: '0ms' } }),
                            React.createElement('div', { className: 'w-2 h-2 bg-gray-400 rounded-full animate-bounce', style: { animationDelay: '150ms' } }),
                            React.createElement('div', { className: 'w-2 h-2 bg-gray-400 rounded-full animate-bounce', style: { animationDelay: '300ms' } })
                        )
                    )
                ),
                React.createElement('div', { ref: messagesEndRef })
            ),

            // Quick Actions (only show if no user messages yet)
            messages.filter(m => m.role === 'user').length === 0 && React.createElement('div', {
                className: 'px-4 py-2 bg-white border-t'
            },
                React.createElement('p', { className: 'text-xs text-gray-600 mb-2' }, 'Quick actions:'),
                React.createElement('div', { className: 'grid grid-cols-2 gap-2' },
                    quickActions.map((action, idx) =>
                        React.createElement('button', {
                            key: idx,
                            onClick: () => handleQuickAction(action.prompt),
                            className: 'text-xs p-2 bg-emerald-50 text-emerald-700 rounded-lg hover:bg-emerald-100 transition text-left'
                        }, action.label)
                    )
                )
            ),

            // Input Area
            React.createElement('div', {
                className: 'p-4 bg-white border-t'
            },
                React.createElement('div', {
                    className: 'flex gap-2'
                },
                    React.createElement('input', {
                        type: 'text',
                        value: input,
                        onChange: (e) => setInput(e.target.value),
                        onKeyPress: handleKeyPress,
                        placeholder: 'Ask me anything about our store...',
                        disabled: isLoading,
                        className: 'flex-1 px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:border-emerald-600'
                    }),
                    React.createElement('button', {
                        onClick: sendMessage,
                        disabled: !input.trim() || isLoading,
                        className: 'w-10 h-10 bg-emerald-600 text-white rounded-full hover:bg-emerald-700 transition disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center'
                    },
                        React.createElement('svg', {
                            className: 'w-5 h-5',
                            fill: 'none',
                            stroke: 'currentColor',
                            viewBox: '0 0 24 24'
                        },
                            React.createElement('path', {
                                strokeLinecap: 'round',
                                strokeLinejoin: 'round',
                                strokeWidth: 2,
                                d: 'M12 19l9 2-9-18-9 18 9-2zm0 0v-8'
                            })
                        )
                    )
                )
            )
        )
    );
}

const root = createRoot(document.getElementById('ai-assistant-root'));
root.render(React.createElement(AiAssistant));
</script>
