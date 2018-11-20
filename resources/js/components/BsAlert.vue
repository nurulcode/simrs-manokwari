<template>
    <div :class="alertClass">
        {{ body }}
    </div>
</template>

<script>
export default {
    computed: {
        alertClass() {
            return [
                {
                    'alert-dismissible': this.dismissible
                },
                `alert-${this.type}`
            ]
        }
    },
    data() {
        return {
            body   : this.message,
            show   : false,
            variant: this.type
        }
    },
    mounted() {
        if (this.message) {
            this.alert(this.message, this.type);
        }

        window.events.$on('bs-alert', (message, type) => {
            this.alert(message, type || 'danger');
        });
    },
    methods: {
        alert(message, type) {
            this.body    = message;
            this.variant = type;
            this.show    = true;
        }
    },
    props: {
        type: {
            type   : String,
            default: 'danger'
        },
        message: {
            type    : String,
            required: false
        },
        dismissible: {
            type   : Boolean,
            default: true
        }
    }
}
</script>