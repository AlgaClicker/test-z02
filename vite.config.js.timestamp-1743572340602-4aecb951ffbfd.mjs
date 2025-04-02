// vite.config.js
import { defineConfig } from "file:///D:/develoop/test-Z02/node_modules/vite/dist/node/index.js";
import laravel from "file:///D:/develoop/test-Z02/node_modules/laravel-vite-plugin/dist/index.js";
import vue from "file:///D:/develoop/test-Z02/node_modules/@vitejs/plugin-vue/dist/index.mjs";
import { globSync } from "file:///D:/develoop/test-Z02/node_modules/glob/dist/esm/index.js";
import tailwindcss from "file:///D:/develoop/test-Z02/node_modules/@tailwindcss/vite/dist/index.mjs";
import path from "path";
var __vite_injected_original_dirname = "D:\\develoop\\test-Z02";
var componentFiles = globSync("resources/js/**/*");
var vite_config_default = defineConfig({
  plugins: [
    vue(),
    tailwindcss(),
    laravel({
      input: [
        "resources/css/app.css",
        "resources/js/app.js",
        "resources/src/App.vue",
        "resources/src/Layout.vue",
        "resources/js/store/index.js",
        ...componentFiles
      ],
      refresh: true
    })
  ],
  alias: {
    "@/": path.resolve(__vite_injected_original_dirname, "resources/src/*"),
    "@components": path.resolve(__vite_injected_original_dirname, "resources/js/components"),
    "@src": path.resolve(__vite_injected_original_dirname, "resources/src")
  }
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcuanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCJEOlxcXFxkZXZlbG9vcFxcXFx0ZXN0LVowMlwiO2NvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9maWxlbmFtZSA9IFwiRDpcXFxcZGV2ZWxvb3BcXFxcdGVzdC1aMDJcXFxcdml0ZS5jb25maWcuanNcIjtjb25zdCBfX3ZpdGVfaW5qZWN0ZWRfb3JpZ2luYWxfaW1wb3J0X21ldGFfdXJsID0gXCJmaWxlOi8vL0Q6L2RldmVsb29wL3Rlc3QtWjAyL3ZpdGUuY29uZmlnLmpzXCI7aW1wb3J0IHsgZGVmaW5lQ29uZmlnIH0gZnJvbSAndml0ZSc7XG5pbXBvcnQgbGFyYXZlbCBmcm9tICdsYXJhdmVsLXZpdGUtcGx1Z2luJztcbmltcG9ydCB2dWUgZnJvbSAnQHZpdGVqcy9wbHVnaW4tdnVlJ1xuaW1wb3J0IHsgZ2xvYlN5bmMgfSBmcm9tICdnbG9iJztcbmltcG9ydCB0YWlsd2luZGNzcyBmcm9tIFwiQHRhaWx3aW5kY3NzL3ZpdGVcIlxuaW1wb3J0IHBhdGggZnJvbSAncGF0aCdcbmNvbnN0IGNvbXBvbmVudEZpbGVzID0gZ2xvYlN5bmMoJ3Jlc291cmNlcy9qcy8qKi8qJyk7XG5cbmV4cG9ydCBkZWZhdWx0IGRlZmluZUNvbmZpZyh7XG4gICAgcGx1Z2luczogW1xuICAgICAgICB2dWUoKSxcbiAgICAgICAgdGFpbHdpbmRjc3MoKSxcbiAgICAgICAgbGFyYXZlbCh7XG4gICAgICAgICAgICBpbnB1dDogW1xuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvY3NzL2FwcC5jc3MnLFxuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvanMvYXBwLmpzJyxcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL3NyYy9BcHAudnVlJyxcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL3NyYy9MYXlvdXQudnVlJyxcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2pzL3N0b3JlL2luZGV4LmpzJyxcbiAgICAgICAgICAgICAgICAuLi5jb21wb25lbnRGaWxlcyxcbiAgICAgICAgICAgIF0sXG5cbiAgICAgICAgICAgIHJlZnJlc2g6IHRydWUsXG4gICAgICAgIH0pLFxuXG4gICAgXSxcbiAgICBhbGlhczoge1xuICAgICAgICBcIkAvXCI6IHBhdGgucmVzb2x2ZShfX2Rpcm5hbWUsIFwicmVzb3VyY2VzL3NyYy8qXCIpLFxuICAgICAgICBcIkBjb21wb25lbnRzXCI6IHBhdGgucmVzb2x2ZShfX2Rpcm5hbWUsIFwicmVzb3VyY2VzL2pzL2NvbXBvbmVudHNcIiksXG4gICAgICAgIFwiQHNyY1wiOiBwYXRoLnJlc29sdmUoX19kaXJuYW1lLCBcInJlc291cmNlcy9zcmNcIiksXG4gICAgfSxcbn0pO1xuIl0sCiAgIm1hcHBpbmdzIjogIjtBQUFvUCxTQUFTLG9CQUFvQjtBQUNqUixPQUFPLGFBQWE7QUFDcEIsT0FBTyxTQUFTO0FBQ2hCLFNBQVMsZ0JBQWdCO0FBQ3pCLE9BQU8saUJBQWlCO0FBQ3hCLE9BQU8sVUFBVTtBQUxqQixJQUFNLG1DQUFtQztBQU16QyxJQUFNLGlCQUFpQixTQUFTLG1CQUFtQjtBQUVuRCxJQUFPLHNCQUFRLGFBQWE7QUFBQSxFQUN4QixTQUFTO0FBQUEsSUFDTCxJQUFJO0FBQUEsSUFDSixZQUFZO0FBQUEsSUFDWixRQUFRO0FBQUEsTUFDSixPQUFPO0FBQUEsUUFDSDtBQUFBLFFBQ0E7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxRQUNBLEdBQUc7QUFBQSxNQUNQO0FBQUEsTUFFQSxTQUFTO0FBQUEsSUFDYixDQUFDO0FBQUEsRUFFTDtBQUFBLEVBQ0EsT0FBTztBQUFBLElBQ0gsTUFBTSxLQUFLLFFBQVEsa0NBQVcsaUJBQWlCO0FBQUEsSUFDL0MsZUFBZSxLQUFLLFFBQVEsa0NBQVcseUJBQXlCO0FBQUEsSUFDaEUsUUFBUSxLQUFLLFFBQVEsa0NBQVcsZUFBZTtBQUFBLEVBQ25EO0FBQ0osQ0FBQzsiLAogICJuYW1lcyI6IFtdCn0K
