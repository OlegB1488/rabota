<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<section>
    <h2>Это вакансии на которые откликнулись</h2>
    <hr>
<div class="cards">
    <div id="app">
        <div class="card" v-for="datas in data">
            <h3>{{ datas.title }}</h3>
            <p>{{ datas.zp }}</p>
            <h3>Резюме студента:</h3>
            <div class="text">
                <p class="p">{{ datas.rezu }}</p>
            </div>
        </div>
    </div>

    <script>
        new Vue({
            el: '#app',
            data() {
                return {
                    data: null,
                    timer: ''
                };
            },
            created: function() {
                this.getData();
                this.timer = setInterval(this.getData, 10000);

            },
            methods: {
                getData: function() {
                    axios
                        .get('http://rabota/frontend/web/site/otklikrdapi')
                        .then(response => (this.data = response.data));
                }
            }
        });
    </script>

</div>
</section>
