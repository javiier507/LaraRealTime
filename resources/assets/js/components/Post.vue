<template>
    <div class="panel-footer">
        <button class="btn btn-primary" @click="vote(id)">
            Votar
        </button>
        <span class="badge" style="float: right">{{ isVotes }}</span>
    </div>
</template>

<script>
    export default {
        props: ['id', 'votes'],

        data: function() {
            return {
                isVotes: '',
            }
        },

        mounted() {
            this.isVotes = this.votes;
        },

        methods: {
            vote(id) {
                var self = this;
                axios.post('/vote', {id: id})
                .then((response) => {
                    console.log(response);

                    if(response.data.operation === true) {
                        self.isVotes++;
                    }
                })
                .catch((response) => {
                    console.log(response);
                });
            }
        }
    }
</script>
