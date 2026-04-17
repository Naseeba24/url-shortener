<template>
  <div style="text-align:center; margin-top:100px;">
    <h1>URL Shortener</h1>

    <input
      v-model="url"
      placeholder="Enter URL"
      style="width:300px; padding:10px;"
    />

    <br /><br />

    <button @click="shortenUrl" style="padding:10px 20px;">
      {{ loading ? "Loading..." : "Shorten" }}
    </button>

    <p v-if="error" style="color:red">{{ error }}</p>

    <p v-if="shortUrl">
      Short URL:
      <a :href="shortUrl" target="_blank">
        {{ shortUrl }}
      </a>
    </p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      url: "",
      shortUrl: "",
      error: "",
      loading: false
    };
  },

  methods: {
    async shortenUrl() {
      this.error = "";
      this.shortUrl = "";

      if (!this.url) {
        this.error = "Please enter a URL";
        return;
      }

      this.loading = true;

      try {
        const res = await fetch("http://localhost/url-shortener/shorten.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify({ url: this.url })
        });

        const data = await res.json();

        if (data.error) {
          this.error = data.error;
        } else {
          this.shortUrl = data.short_url;
        }
      } catch (e) {
        this.error = "Server error";
      }

      this.loading = false;
    }
  }
};
</script>