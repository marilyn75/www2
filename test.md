```mermaid
---
title: Ajax 처리
---
sequenceDiagram
    FrontEnd->>BackEnd: doAjax(url, params) 함수 호출
    BackEnd-->>FrontEnd: ResultClass Json 리턴
```