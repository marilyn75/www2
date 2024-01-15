```mermaid
---
title: 회원가입 프로세스
---
flowchart LR
    A[시작] --> B{가입방법}
    B -->|email| C[휴대폰번호인증]
    C --> D[가입완료]
    B -->|sns인증| D
```
---

```mermaid
---
title: 계정찾기 프로세스
---
flowchart LR
    A[시작] --> B((이름,휴대폰번호입력))
    B --> C{가입정보유무}
    C --> |Y| D[가입정보 표시 email, sns]
    C --> |N| E[가입정보가 없습니다.]
```
---