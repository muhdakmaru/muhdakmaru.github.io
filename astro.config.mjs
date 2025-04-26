import { defineConfig } from "astro/config";
import tailwind from "@astrojs/tailwind";
import icon from "astro-icon";
import { remarkReadingTime } from "./remark-reading-time.mjs";
import node from "@astrojs/node";

// https://astro.build/config
export default defineConfig({
  integrations: [tailwind(), icon()],
  site: "https://muhdakmaru.github.io",
  adapter: node({
    mode: "standalone",
  }),
  markdown: {
    remarkPlugins: [remarkReadingTime],
  },
});
