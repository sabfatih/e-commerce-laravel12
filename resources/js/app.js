import "./bootstrap";

import Alpine from "alpinejs";
import { intersect } from "@alpinejs/intersect";
import collapse from "@alpinejs/collapse";

window.Alpine = Alpine;
Alpine.plugin([intersect, collapse]);

Alpine.start();
